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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    public function __construct(private ReadabilityService $readability) {}

    // Display the list of articles with filtering options
    #[Route('/article', name: 'app_article_index', methods: ['GET'])]
    public function index(
        Request $request,
        ArticleRepository $articleRepository,
        CategorieRepository $categorieRepository,
        LearningPathRepository $pathRepository,
        TagRepository $tagRepository
    ): Response {
        $q     = trim($request->query->get('q', ''));
        $catId = $request->query->get('categorie');
        $tag   = $request->query->get('tag');

        if ($q !== '') {
            $articles = $articleRepository->search($q);
        } elseif ($catId) {
            $articles = $articleRepository->findByCategorieId((int) $catId);
        } elseif ($tag) {
            $articles = $articleRepository->findByTagName($tag);
        } else {
            $articles = $articleRepository->findAllWithCategory();
        }

        return $this->render('article/index.html.twig', [
            'articles'   => $articles,
            'categories' => $categorieRepository->findAllOrderedByNom(),
            'paths'      => $pathRepository->findAllWithCreator(),
            'tags'       => $tagRepository->findAllWithCount(),
            'activeTag'  => $tag,
        ]);
    }

    // Create a new article
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
            // Set author
            $article->setAuteur($this->getUser());

            // Calculate readability automatically
            $article->setReadability(
                $this->readability->calculateLevel($article->getContenu())
            );

            // Auto-assign tags from content keywords
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

    // Show a single article with related info
    #[Route('/article/{id}', name: 'app_article_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(
        Article $article,
        LearningPathRepository $pathRepository,
        PathArticleRepository $paRepository,
        TagRepository $tagRepository
    ): Response {
        $paths       = $pathRepository->findByArticle($article->getId());
        $nextStep    = null;
        $currentStep = null;
        $totalSteps  = 0;
        $currentPath = null;

        if (!empty($paths)) {
            $currentPath = $paths[0];
            $entry = $paRepository->findEntry($currentPath->getId(), $article->getId());
            if ($entry) {
                $currentStep = $entry->getArticleOrder();
                $totalSteps  = $paRepository->countSteps($currentPath->getId());
                $nextStep    = $paRepository->findNext($currentPath->getId(), $currentStep);
            }
        }

        $relatedArticles = $tagRepository->findRelatedArticles($article, 3);

        return $this->render('article/show.html.twig', [
            'article'         => $article,
            'currentPath'     => $currentPath,
            'currentStep'     => $currentStep,
            'totalSteps'      => $totalSteps,
            'nextStep'        => $nextStep,
            'relatedArticles' => $relatedArticles,
        ]);
    }

    // Show articles filtered by a specific tag
    #[Route('/article/tag/{tagName}', name: 'app_article_by_tag', methods: ['GET'])]
    public function byTag(
        string $tagName,
        ArticleRepository $articleRepository,
        CategorieRepository $categorieRepository,
        LearningPathRepository $pathRepository,
        TagRepository $tagRepository
    ): Response {
        return $this->render('article/index.html.twig', [
            'articles'   => $articleRepository->findByTagName($tagName),
            'categories' => $categorieRepository->findAllOrderedByNom(),
            'paths'      => $pathRepository->findAllWithCreator(),
            'tags'       => $tagRepository->findAllWithCount(),
            'activeTag'  => $tagName,
        ]);
    }

    // Edit an existing article
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
            // Recalculate readability on every save
            $article->setReadability(
                $this->readability->calculateLevel($article->getContenu())
            );

            // Clear old tags and re-assign from new content
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
    // Delete an article    
    #[Route('/article/{id}', name: 'app_article_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->getPayload()->getString('_token'))) {
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }

    // Automatically assign tags based on keywords in the article content
    private function autoAssignTags(Article $article, TagRepository $tagRepo, EntityManagerInterface $em): void
    {
        $content = mb_strtolower($article->getContenu() . ' ' . $article->getTitre());

        // Psychology keyword dictionary — maps keywords to tag names
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
                $tagsToAssign[$tagName] = true; // deduplicate
            }
        }

        foreach (array_keys($tagsToAssign) as $tagName) {
            // Find existing tag or create it
            $tag = $tagRepo->findByNom($tagName);
            if (!$tag) {
                $tag = new \App\Entity\Tag();
                $tag->setNom($tagName);
                $em->persist($tag);
            }

            // Only add if not already assigned
            if (!$article->getTags()->contains($tag)) {
                $article->addTag($tag);
            }
        }
    }
}