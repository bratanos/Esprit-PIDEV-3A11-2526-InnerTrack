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
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(LearningPathRepository $repo): Response
    {
        return $this->render('learning_path/index.html.twig', [
            'paths' => $repo->findAllWithCreator(),
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(LearningPath $path): Response
    {
        $steps = $path->getPathArticles()->toArray();
        $total = count($steps);

        return $this->render('learning_path/show.html.twig', [
            'learningPath' => $path,
            'steps'        => $steps,
            'total'        => $total,
        ]);
    }

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

    #[Route('/new', name: 'create', methods: ['POST'])]
    public function create(
        Request $request,
        LearningPathRepository $repo,
        ArticleRepository $articleRepo,
        EntityManagerInterface $em
    ): Response {
        // ✅ :62/:63 — request->get() returns mixed, cast to string before trim
        $titre       = trim((string) $request->request->get('titre', ''));
        $description = trim((string) $request->request->get('description', ''));
        $articleIds  = $request->request->all('articleIds');
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

        // ✅ :81 — getUser() returns UserInterface|null, setCreatedBy expects User|null
        $user = $this->getUser();
        if (!$user instanceof \App\Entity\User) {
            throw new \LogicException('Unexpected user type.');
        }

        $path = new LearningPath();
        $path->setTitre($titre)
             ->setDescription($description ?: null)
             ->setCreatedBy($user)
             ->setDateCreation(new \DateTime());

        $em->persist($path);

        foreach ($articleIds as $order => $articleId) {
            $article = $articleRepo->find((int) $articleId);
            if (!$article instanceof \App\Entity\Article) continue;


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

    #[Route('/{id}/edit', name: 'edit', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function edit(LearningPath $path, ArticleRepository $articleRepo): Response
    {
        // ✅ :108 — getArticle() returns ?Article, getId() can't be called on null
        $currentIds = $path->getPathArticles()
            ->map(fn(PathArticle $pa) => $pa->getArticle()?->getId())
            ->toArray();

        return $this->render('learning_path/form.html.twig', [
            'path'       => $path,
            'articles'   => $articleRepo->findAllWithCategory(),
            'currentIds' => $currentIds,
            'errors'     => [],
            'old'        => ['titre' => $path->getTitre(), 'description' => $path->getDescription()],
        ]);
    }

    #[Route('/{id}/edit', name: 'update', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function update(
        Request $request,
        LearningPath $path,
        ArticleRepository $articleRepo,
        EntityManagerInterface $em
    ): Response {
        // ✅ :128/:129 — same cast as create()
        $titre       = trim((string) $request->request->get('titre', ''));
        $description = trim((string) $request->request->get('description', ''));
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

        foreach ($path->getPathArticles() as $pa) {
            $em->remove($pa);
        }
        $em->flush();

        $path->setTitre($titre)->setDescription($description ?: null);

        foreach ($articleIds as $order => $articleId) {
            $article = $articleRepo->find((int) $articleId);
            if (!$article instanceof \App\Entity\Article) continue;
            $pa = new PathArticle();
            $pa->setLearningPath($path)->setArticle($article)->setArticleOrder($order + 1);
            $em->persist($pa);
        }

        $em->flush();

        $this->addFlash('success', 'Learning path updated.');
        return $this->redirectToRoute('app_learning_path_show', ['id' => $path->getId()]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(
        Request $request,
        LearningPath $path,
        LearningPathRepository $repo
    ): Response {
        // ✅ :173 — request->get() returns mixed, isCsrfTokenValid expects string|null
        $token = $request->request->get('_token');
        if ($this->isCsrfTokenValid('delete_lp_' . $path->getId(), $token !== null ? (string) $token : null)) {
            $repo->remove($path);
            $this->addFlash('success', 'Learning path deleted.');
        }
        return $this->redirectToRoute('app_learning_path_index');
    }
}