<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\LearningPathRepository;
use App\Repository\PathArticleRepository;
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

    #[Route('/article', name: 'app_article_index', methods: ['GET'])]
    public function index(
        Request $request,
        ArticleRepository $articleRepository,
        CategorieRepository $categorieRepository,
        LearningPathRepository $pathRepository,
        TagRepository $tagRepository
    ): Response {
        // ✅ :44 — get() returns mixed, cast to string before trim
        $q     = trim((string) $request->query->get('q', ''));
        // ✅ :50 — catId and tag must be string|null, not mixed
        $catId = $request->query->get('categorie');
        $catId = $catId !== null ? (string) $catId : null;
        $tag   = $request->query->get('tag');
        $tag   = $tag !== null ? (string) $tag : null;
        $page  = max(1, (int) $request->query->get('page', 1));

        $qb = $articleRepository->createQueryBuilderForIndex($q, $catId, $tag);

        $pager = new Pagerfanta(new QueryAdapter($qb));
        $pager->setMaxPerPage(10);
        $pager->setCurrentPage($page);

        return $this->render('article/index.html.twig', [
            'pager'      => $pager,
            'articles'   => $pager->getCurrentPageResults(),
            'categories' => $categorieRepository->findAllOrderedByNom(),
            'paths'      => $pathRepository->findAllWithCreator(),
            'tags'       => $tagRepository->findAllWithCount(),
            'activeTag'  => $tag,
        ]);
    }

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
            $user = $this->getUser();
            if (!$user instanceof \App\Entity\User) {
                throw new \LogicException('Unexpected user type.');
            }
            $article->setAuteur($user);

            // ✅ :86 — getContenu() returns ?string, guard against null
            $contenu = $article->getContenu() ?? '';
            $article->setReadability($this->readability->calculateLevel($contenu));

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

    #[Route('/article/{id}', name: 'app_article_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(
        Article $article,
        LearningPathRepository $pathRepository,
        PathArticleRepository $paRepository,
        TagRepository $tagRepository,
        OpenLibraryService $openLibrary,
        FreeSoundService $freesound,
        AiInsightService $aiInsight
    ): Response {
        // ✅ :115 — getId() returns int|null, guard against null
        $articleId = $article->getId();
        if ($articleId === null) {
            throw new \LogicException('Article has no ID.');
        }

        $paths       = $pathRepository->findByArticle($articleId);
        $nextStep    = null;
        $currentStep = null;
        $totalSteps  = 0;
        $currentPath = null;

        if (!empty($paths)) {
            $currentPath = $paths[0];

            // ✅ :123 — getId() on LearningPath returns int|null, guard it
            $pathId = $currentPath->getId();
            if ($pathId === null) {
                throw new \LogicException('LearningPath has no ID.');
            }

            $entry = $paRepository->findEntry($pathId, $articleId);
            if ($entry) {
                $currentStep = $entry->getArticleOrder();
                $totalSteps  = $paRepository->countSteps($pathId);
                $nextStep    = $paRepository->findNext($pathId, $currentStep);
            }
        }

        $relatedArticles = $tagRepository->findRelatedArticles($article, 3);

        // ✅ :135 — first() returns Tag|false, getNom() can't be called on false
        // ✅ :141 — searchTerm must be string, not string|null
        $firstTag = $article->getTags()->first();
        $searchTerm = $article->getCategorie()?->getNom()
            ?? ($firstTag !== false ? $firstTag->getNom() : null)
            ?? $article->getTitre()
            ?? '';

        $bookRecommendations = $openLibrary->searchBooks($searchTerm . ' psychology');
        $ambientSound        = $freesound->findAmbientSound($article);

        $wikiSummary = null;

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
                        'action'   => 'query',
                        'list'     => 'search',
                        'srsearch' => $searchTerm,
                        'format'   => 'json',
                        'srlimit'  => 1,
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
            'article'             => $article,
            'currentPath'         => $currentPath,
            'currentStep'         => $currentStep,
            'totalSteps'          => $totalSteps,
            'nextStep'            => $nextStep,
            'relatedArticles'     => $relatedArticles,
            'wikiSummary'         => $wikiSummary,
            'bookRecommendations' => $bookRecommendations,
            'ambientSound'        => $ambientSound,
            'aiAnalysis'          => $aiAnalysis,
        ]);
    }

    #[Route('/article/tag/{tagName}', name: 'app_article_by_tag', methods: ['GET'])]
    public function byTag(string $tagName): Response
    {
        return $this->redirectToRoute('app_article_index', ['tag' => $tagName]);
    }

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
            // ✅ :234 — getContenu() returns ?string, guard against null
            $contenu = $article->getContenu() ?? '';
            $article->setReadability($this->readability->calculateLevel($contenu));

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

    #[Route('/article/{id}', name: 'app_article_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->getPayload()->getString('_token'))) {
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }

    private function autoAssignTags(Article $article, TagRepository $tagRepo, EntityManagerInterface $em): void
    {
        $content = mb_strtolower(($article->getContenu() ?? '') . ' ' . ($article->getTitre() ?? ''));

        $keywordMap = [
            'anxiety'       => 'anxiety',
            'anxious'       => 'anxiety',
            'depression'    => 'depression',
            'depressed'     => 'depression',
            'mindfulness'   => 'mindfulness',
            'meditation'    => 'mindfulness',
            'therapy'       => 'therapy',
            'therapist'     => 'therapy',
            'psychotherapy' => 'therapy',
            'stress'        => 'stress',
            'burnout'       => 'stress',
            'sleep'         => 'sleep',
            'insomnia'      => 'sleep',
            'relationship'  => 'relationships',
            'relationships' => 'relationships',
            'trauma'        => 'trauma',
            'ptsd'          => 'trauma',
            'cbt'           => 'cbt',
            'cognitive'     => 'cbt',
            'self-care'     => 'self-care',
            'wellbeing'     => 'self-care',
            'well-being'    => 'self-care',
            'emotion'       => 'emotions',
            'emotions'      => 'emotions',
            'grief'         => 'grief',
            'loss'          => 'grief',
            'addiction'     => 'addiction',
            'phobia'        => 'phobia',
            'panic'         => 'panic',
            'resilience'    => 'resilience',
            'mental health' => 'mental-health',
            'self-esteem'   => 'self-esteem',
            'confidence'    => 'self-esteem',
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

    #[Route('/article/{id}/pdf', name: 'app_article_pdf', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function exportPdf(Article $article, Pdf $pdf, Environment $twig): Response
    {
        $html     = $twig->render('article/pdf.html.twig', ['article' => $article]);
        $filename = sprintf('article-%s.pdf', $article->getId());

        return new Response(
            $pdf->getOutputFromHtml($html, [
                'footer-html'    => $twig->render('article/pdf_footer.html.twig', ['article' => $article]),
                'header-html'    => $twig->render('article/pdf_header.html.twig'),
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