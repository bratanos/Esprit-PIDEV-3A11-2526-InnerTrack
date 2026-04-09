<?php

namespace App\Controller\Journal;

use App\Entity\Journal\EntreeJournal;
use App\Form\Journal\EntreeJournalType;
use App\Repository\Journal\EntreeJournalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\PdfExporter;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

#[Route('/journal/entree', name: 'entree_')]
class EntreeJournalController extends AbstractController
{
    public function __construct(
        private EntreeJournalRepository $repo,
        private EntityManagerInterface  $em,
        private Security                $security
    ) {}

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $user    = $this->security->getUser();
        $keyword = $request->query->get('q', '');
        $date    = $request->query->get('date');
        $humeur  = $request->query->get('humeur');
        $sort    = $request->query->get('sort', 'dateSaisie'); 
        $direction = $request->query->get('direction', 'DESC');  

        $entrees = $this->repo->searchAdvanced(
            $user->getId(),
            $keyword,
            $date,
            $humeur,
            $sort,
            $direction
        );

        $stats = $this->repo->getStatsByUserId($user->getId());

        return $this->render('journal/entree/index.html.twig', [
            'entrees'          => $entrees,
            'keyword'          => $keyword,
            'date'             => $date,
            'humeur'           => $humeur,
            'stats'            => $stats,
            'currentSort'      => $sort,      
            'currentDirection' => $direction, 
        ]);
    }

    #[Route('/ajouter', name: 'ajouter')]
    public function ajouter(Request $request): Response
    {
        $entree = new EntreeJournal();
        $form   = $this->createForm(EntreeJournalType::class, $entree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entree->setUser($this->security->getUser());
            $this->em->persist($entree);
            $this->em->flush();
            $this->addFlash('success', '✅ Entrée ajoutée !');
            return $this->redirectToRoute('entree_index');
        }

        return $this->render('journal/entree/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function modifier(EntreeJournal $entree, Request $request): Response
    {
        $form = $this->createForm(EntreeJournalType::class, $entree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', '✅ Entrée modifiée !');
            return $this->redirectToRoute('entree_index');
        }

        return $this->render('journal/entree/modifier.html.twig', [
            'form'   => $form->createView(),
            'entree' => $entree,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer', methods: ['POST'])]
    public function supprimer(EntreeJournal $entree, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete-entree-' . $entree->getIdJournal(), $request->request->get('_token'))) {
            $this->em->remove($entree);
            $this->em->flush();
            $this->addFlash('success', '✅ Entrée supprimée !');
        }
        return $this->redirectToRoute('entree_index');
    }

    #[Route('/voir/{id}', name: 'voir')]
    public function voir(EntreeJournal $entree): Response
    {
        return $this->render('journal/entree/voir.html.twig', [
            'entree' => $entree,
        ]);
    }

    #[Route('/export/pdf', name: 'export_pdf')]
    public function exportPdf(PdfExporter $pdfExporter): Response 
    {
        $user = $this->getUser();
        $entrees = $this->repo->findByUserId($user->getId());

        $tmpFile = tempnam(sys_get_temp_dir(), 'journal') . '.pdf';
        $pdfExporter->exportJournal($entrees, $tmpFile);

        return $this->file($tmpFile, 'MonJournal.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }
}