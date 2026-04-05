<?php

namespace App\Controller\Journal;

use App\Entity\Journal\Habitude;
use App\Form\Journal\HabitudeType;
use App\Repository\Journal\HabitudeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/journal/habitude', name: 'habitude_')]
class HabitudeController extends AbstractController
{
    public function __construct(
        private HabitudeRepository     $repo,
        private EntityManagerInterface $em,
        private Security               $security
    ) {}

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $user      = $this->security->getUser();
        $keyword   = $request->query->get('q', '');
        $habitudes = $keyword
            ? $this->repo->search($keyword, $user->getId())
            : $this->repo->findByUserId($user->getId());
        $stats     = $this->repo->getStatsByUserId($user->getId());

        return $this->render('journal/habitude/index.html.twig', [
            'habitudes' => $habitudes,
            'keyword'   => $keyword,
            'stats'     => $stats,
        ]);
    }

    #[Route('/ajouter', name: 'ajouter')]
    public function ajouter(Request $request): Response
    {
        $habitude = new Habitude();
        $form     = $this->createForm(HabitudeType::class, $habitude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $habitude->setUser($this->security->getUser());
            $this->em->persist($habitude);
            $this->em->flush();
            $this->addFlash('success', '✅ Habitude ajoutée !');
            return $this->redirectToRoute('habitude_index');
        }

        return $this->render('journal/habitude/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function modifier(Habitude $habitude, Request $request): Response
    {
        $form = $this->createForm(HabitudeType::class, $habitude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', '✅ Habitude modifiée !');
            return $this->redirectToRoute('habitude_index');
        }

        return $this->render('journal/habitude/modifier.html.twig', [
            'form'     => $form->createView(),
            'habitude' => $habitude,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer', methods: ['POST'])]
    public function supprimer(Habitude $habitude, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete-habitude-' . $habitude->getIdHabit(), $request->request->get('_token'))) {
            $this->em->remove($habitude);
            $this->em->flush();
            $this->addFlash('success', '✅ Habitude supprimée !');
        }
        return $this->redirectToRoute('habitude_index');
    }

    #[Route('/voir/{id}', name: 'voir')]
    public function voir(Habitude $habitude): Response
    {
        return $this->render('journal/habitude/voir.html.twig', [
            'habitude' => $habitude,
        ]);
    }
}