<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\TagRepository;
use App\Service\ReadabilityService;
use App\Service\OpenLibraryService;
use App\Service\FreeSoundService;
use App\Service\AiInsightService;
use Knp\Snappy\Pdf;
use Twig\Environment;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


final class ArticleController extends AbstractController
{
    public function __construct(private ReadabilityService $readability, private HttpClientInterface $client) {}

    /**
     * Displays paginated list of articles with filtering by search, category, and tags
     */
    #[Route('/article', name: 'app_article_index', methods: ['GET'])]
    public function index(
        Request $request,
        ArticleRepository $articleRepository,
        CategorieRepository $categorieRepository,
        TagRepository $tagRepository
    ): Response {
            $q     = trim($request->query->get('q', ''));
            $catId = $request->query->get('categorie');
            $tag   = $request->query->get('tag');
            $page  = max(1, (int) $request->query->get('page', 1));


        $qb = $articleRepository->createQueryBuilderForIndex($q, $catId, $tag);

        $pager = new Pagerfanta(new QueryAdapter($qb));
        $pager->setMaxPerPage(10);
        $pager->setCurrentPage($page);

        return $this->render('article/index.html.twig', [
            'pager'      => $pager,
            'articles'   => $pager->getCurrentPageResults(),
            'categories' => $categorieRepository->findAllOrderedByNom(),
            'tags'       => $tagRepository->findAllWithCount(),
            'activeTag'  => $tag,
        ]);
    }

    /**
     * Creates a new article with automatic readability calculation and tag assignment
     */
    #[Route('/article/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        TagRepository $tagRepository
    ): Response {
        $article = new Article();
        $form    = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setAuteur($this->getUser());
            $article->setReadability(
                $this->readability->calculateLevel($article->getContenu())
            );
            $this->autoAssignTags($article, $tagRepository, $em);

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form'    => $form,
        ]);
    }

    /**
     * Displays a single article with related articles, Wikipedia summary, book recommendations, and AI insights
     */
    #[Route('/article/{id}', name: 'app_article_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(
        Article $article,
        TagRepository $tagRepository,
        OpenLibraryService $openLibrary,
        FreeSoundService $freesound,
        AiInsightService $aiInsight
    ): Response {
        $relatedArticles = $tagRepository->findRelatedArticles($article, 3);

        $wikiSummary = null;
        $searchTerm = $article->getCategorie()?->getNom()
        ?? ($article->getTags()->count() > 0 ? $article->getTags()->first()->getNom() : $article->getTitre());

        $bookRecommendations = $openLibrary->searchBooks($searchTerm . ' psychology');
        $ambientSound = $freesound->findAmbientSound($article); 
        
        try {
            $response = $this->client->request('GET', 'https://en.wikipedia.org/api/rest_v1/page/summary/' . rawurlencode($searchTerm), [
                'timeout' => 5,
            ]);

            if ($response->getStatusCode() === 200) {
                $wiki = $response->toArray(false);
                $wikiSummary = [
                    'title'   => $wiki['title'] ?? $searchTerm,
                    'extract' => mb_substr($wiki['extract'] ?? '', 0, 400) . '…',
                    'url'     => $wiki['content_urls']['desktop']['page'] ?? '#',
                ];
            } else {
                throw new \RuntimeException('Summary not found');
            }
        } catch (\Throwable $e) {
            try {
                $searchResponse = $this->client->request('GET', 'https://en.wikipedia.org/w/api.php', [
                    'query' => [
                        'action' => 'query',
                        'list' => 'search',
                        'srsearch' => $searchTerm,
                        'format' => 'json',
                        'srlimit' => 1,
                    ],
                    'timeout' => 5,
                ]);

                $searchData = $searchResponse->toArray(false);

                if (!empty($searchData['query']['search'][0]['title'])) {
                    $bestTitle = $searchData['query']['search'][0]['title'];

                    $summaryResponse = $this->client->request(
                        'GET',
                        'https://en.wikipedia.org/api/rest_v1/page/summary/' . rawurlencode($bestTitle),
                        ['timeout' => 5]
                    );

                    if ($summaryResponse->getStatusCode() === 200) {
                        $wiki = $summaryResponse->toArray(false);
                        $wikiSummary = [
                            'title'   => $wiki['title'] ?? $bestTitle,
                            'extract' => mb_substr($wiki['extract'] ?? '', 0, 400) . '…',
                            'url'     => $wiki['content_urls']['desktop']['page'] ?? '#',
                        ];
                    }
                }
            } catch (\Throwable $e) {
                // optional logging
            }
        }

        $aiAnalysis = $aiInsight->analyze($article);
        return $this->render('article/show.html.twig', [
            'article'         => $article,
            'relatedArticles' => $relatedArticles,
            'wikiSummary' => $wikiSummary,
            'bookRecommendations' => $bookRecommendations,
            'ambientSound' => $ambientSound, 
            'aiAnalysis' => $aiAnalysis,   
            ]);
    }

    /**
     * Formats Wikipedia API response data into a structured summary array
     */
    private function formatWikiSummary(array $wiki): array
    {
        return [
            'title'   => $wiki['title'],
            'extract' => mb_substr($wiki['extract'], 0, 400) . '…',
            'url'     => $wiki['content_urls']['desktop']['page'] ?? '#',
        ];
    }

    /**
     * Redirects to the article index filtered by a specific tag
     */
    #[Route('/article/tag/{tagName}', name: 'app_article_by_tag', methods: ['GET'])]
    public function byTag(string $tagName): Response
    {
        return $this->redirectToRoute('app_article_index', ['tag' => $tagName]);
    }

    /**
     * Edits an existing article with updated readability and tag reassignment
     */
    #[Route('/article/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(
        Request $request,
        Article $article,
        EntityManagerInterface $em,
        TagRepository $tagRepository
    ): Response {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setReadability(
                $this->readability->calculateLevel($article->getContenu())
            );

            foreach ($article->getTags() as $tag) {
                $article->removeTag($tag);
            }
            $this->autoAssignTags($article, $tagRepository, $em);

            $em->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form'    => $form,
        ]);
    }
    /**
     * Deletes an article after CSRF token validation
     */
    #[Route('/article/{id}', name: 'app_article_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->getPayload()->getString('_token'))) {
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Automatically assigns tags to an article based on psychology-related keywords found in its content
     */
    private function autoAssignTags(Article $article, TagRepository $tagRepo, EntityManagerInterface $em): void
    {
        $content = mb_strtolower($article->getContenu() . ' ' . $article->getTitre());

        $keywordMap = [
            'anxiety'        => 'anxiety',
            'anxious'        => 'anxiety',
            'depression'     => 'depression',
            'depressed'      => 'depression',
            'mindfulness'    => 'mindfulness',
            'meditation'     => 'mindfulness',
            'therapy'        => 'therapy',
            'therapist'      => 'therapy',
            'psychotherapy'  => 'therapy',
            'stress'         => 'stress',
            'burnout'        => 'stress',
            'sleep'          => 'sleep',
            'insomnia'       => 'sleep',
            'relationship'   => 'relationships',
            'relationships'  => 'relationships',
            'trauma'         => 'trauma',
            'ptsd'           => 'trauma',
            'cbt'            => 'cbt',
            'cognitive'      => 'cbt',
            'self-care'      => 'self-care',
            'wellbeing'      => 'self-care',
            'well-being'     => 'self-care',
            'emotion'        => 'emotions',
            'emotions'       => 'emotions',
            'grief'          => 'grief',
            'loss'           => 'grief',
            'addiction'      => 'addiction',
            'phobia'         => 'phobia',
            'panic'          => 'panic',
            'resilience'     => 'resilience',
            'mental health'  => 'mental-health',
            'self-esteem'    => 'self-esteem',
            'confidence'     => 'self-esteem',
        ];

        $tagsToAssign = [];

        foreach ($keywordMap as $keyword => $tagName) {
            if (str_contains($content, $keyword)) {
                $tagsToAssign[$tagName] = true;
            }
        }

        foreach (array_keys($tagsToAssign) as $tagName) {
            $tag = $tagRepo->findByNom($tagName);
            if (!$tag) {
                $tag = new \App\Entity\Tag();
                $tag->setNom($tagName);
                $em->persist($tag);
            }

            if (!$article->getTags()->contains($tag)) {
                $article->addTag($tag);
            }
        }
    }

    /**
     * Exports an article as a PDF file with header and footer
     */
    #[Route('/article/{id}/pdf', name: 'app_article_pdf', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function exportPdf(Article $article, Pdf $pdf, Environment $twig): Response
    {
        $html = $twig->render('article/pdf.html.twig', [
            'article' => $article,
        ]);

        $filename = sprintf('article-%s.pdf', $article->getId());

        return new Response(
            $pdf->getOutputFromHtml($html, [
                'footer-html'   => $twig->render('article/pdf_footer.html.twig', ['article' => $article]),
                'header-html'   => $twig->render('article/pdf_header.html.twig'),
                'footer-spacing' => 5,
                'header-spacing' => 5,
            ]),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }
}