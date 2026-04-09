<?php

namespace App\Controller;

use App\Entity\LearningPath;
use App\Entity\PathArticle;
use App\Repository\ArticleRepository;
use App\Repository\LearningPathRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/learning-path', name: 'app_learning_path_')]
class LearningPathController extends AbstractController
{
    // List all learning paths
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(LearningPathRepository $repo): Response
    {
        return $this->render('learning_path/index.html.twig', [
            'paths' => $repo->findAllWithCreator(),
        ]);
    }

    // Show a learning path with its steps
    #[Route('/{id}', name: 'show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(LearningPath $path): Response
    {
        // pathArticles are already ordered ASC by articleOrder (see entity)
        $steps = $path->getPathArticles()->toArray();
        $total = count($steps);

        return $this->render('learning_path/show.html.twig', [
            'learningPath' => $path,
            'steps' => $steps,   // PathArticle[]
            'total' => $total,
        ]);
    }

    // Show form to create a new learning path
    #[Route('/new', name: 'new', methods: ['GET'])]
    public function new(ArticleRepository $articleRepo): Response
    {
        return $this->render('learning_path/form.html.twig', [
            'path'     => null,
            'articles' => $articleRepo->findAllWithCategory(),
            'errors'   => [],
            'old'      => ['dateCreation' => date('Y-m-d')],
        ]);
    }

    // Create a new learning path
    #[Route('/new', name: 'create', methods: ['POST'])]
    public function create(
        Request $request,
        LearningPathRepository $repo,
        ArticleRepository $articleRepo,
        EntityManagerInterface $em
    ): Response {
        $titre       = trim($request->request->get('titre', ''));
        $description = trim($request->request->get('description', ''));
        $articleIds  = $request->request->all('articleIds'); // ordered array of IDs
        $errors      = [];

        if ($titre === '') $errors['titre'] = 'Title is required.';

        if ($errors) {
            return $this->render('learning_path/form.html.twig', [
                'path'     => null,
                'articles' => $articleRepo->findAllWithCategory(),
                'errors'   => $errors,
                'old'      => ['titre' => $titre, 'description' => $description],
            ]);
        }

        $path = new LearningPath();
        $path->setTitre($titre)
             ->setDescription($description ?: null)
             ->setCreatedBy($this->getUser())
             ->setDateCreation(new \DateTime());

        $em->persist($path);

        foreach ($articleIds as $order => $articleId) {
            $article = $articleRepo->find((int) $articleId);
            if (!$article) continue;

            $pa = new PathArticle();
            $pa->setLearningPath($path)
               ->setArticle($article)
               ->setArticleOrder($order + 1);
            $em->persist($pa);
        }

        $em->flush();

        $this->addFlash('success', "Learning path \"$titre\" created successfully.");
        return $this->redirectToRoute('app_learning_path_show', ['id' => $path->getId()]);
    }

    // Show form to edit a learning path
    #[Route('/{id}/edit', name: 'edit', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function edit(LearningPath $path, ArticleRepository $articleRepo): Response
    {
        $currentIds = $path->getPathArticles()
            ->map(fn(PathArticle $pa) => $pa->getArticle()->getId())
            ->toArray();

        return $this->render('learning_path/form.html.twig', [
            'path'       => $path,
            'articles'   => $articleRepo->findAllWithCategory(),
            'currentIds' => $currentIds,
            'errors'     => [],
            'old'        => ['titre' => $path->getTitre(), 'description' => $path->getDescription()],
        ]);
    }

    // Update an existing learning path
    #[Route('/{id}/edit', name: 'update', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function update(
        Request $request,
        LearningPath $path,
        ArticleRepository $articleRepo,
        EntityManagerInterface $em
    ): Response {
        $titre       = trim($request->request->get('titre', ''));
        $description = trim($request->request->get('description', ''));
        $articleIds  = $request->request->all('articleIds');
        $errors      = [];

        if ($titre === '') $errors['titre'] = 'Title is required.';

        if ($errors) {
            return $this->render('learning_path/form.html.twig', [
                'path'     => $path,
                'articles' => $articleRepo->findAllWithCategory(),
                'errors'   => $errors,
                'old'      => ['titre' => $titre, 'description' => $description],
            ]);
        }

        // Remove existing path articles and re-create
        foreach ($path->getPathArticles() as $pa) {
            $em->remove($pa);
        }
        $em->flush();

        $path->setTitre($titre)->setDescription($description ?: null);

        foreach ($articleIds as $order => $articleId) {
            $article = $articleRepo->find((int) $articleId);
            if (!$article) continue;
            $pa = new PathArticle();
            $pa->setLearningPath($path)->setArticle($article)->setArticleOrder($order + 1);
            $em->persist($pa);
        }

        $em->flush();

        $this->addFlash('success', 'Learning path updated.');
        return $this->redirectToRoute('app_learning_path_show', ['id' => $path->getId()]);
    }

    // Delete a learning path
    #[Route('/{id}/delete', name: 'delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(
        Request $request,
        LearningPath $path,
        LearningPathRepository $repo
    ): Response {
        if ($this->isCsrfTokenValid('delete_lp_' . $path->getId(), $request->request->get('_token'))) {
            $repo->remove($path);
            $this->addFlash('success', 'Learning path deleted.');
        }
        return $this->redirectToRoute('app_learning_path_index');
    }
}
