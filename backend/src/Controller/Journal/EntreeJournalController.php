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
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

#[Route('/journal/entree', name: 'entree_')]
class EntreeJournalController extends AbstractController
{
    public function __construct(
        private EntreeJournalRepository   $repo,
        private EntityManagerInterface    $em,
        private Security                  $security,
        private CsrfTokenManagerInterface $csrfTokenManager
    ) {}

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $user = $this->security->getUser();

        if (!$user instanceof \App\Entity\User) {
            throw $this->createAccessDeniedException();
        }

        $userId    = (int) $user->getId();
        $keyword   = (string) $request->query->get('q', '');
        $date      = (string) $request->query->get('date', '');
        $humeur    = $request->query->get('humeur') !== null ? (int) $request->query->get('humeur') : null;
        $sort      = (string) $request->query->get('sort', 'dateSaisie');
        $direction = (string) $request->query->get('direction', 'DESC');

        $entrees = $this->repo->searchAdvanced(
            $userId,
            $keyword,
            $date,
            $humeur,
            $sort,
            $direction
        );

        $stats = $this->repo->getStatsByUserId($userId);

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
            $user = $this->security->getUser();

            if (!$user instanceof \App\Entity\User) {
                throw $this->createAccessDeniedException();
            }

            $entree->setUser($user);
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
        if ($this->isCsrfTokenValid(
            'delete-entree-' . $entree->getIdJournal(),
            (string) $request->request->get('_token')
        )) {
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

    #[Route('/qrcode/{id}', name: 'qrcode')]
    public function qrcode(int $id): Response
    {
        /** @var EntreeJournal|null $entree */
        $entree = $this->repo->findOneBy(['idJournal' => $id]);

        if (!$entree instanceof EntreeJournal) {
            throw $this->createNotFoundException('Entrée non trouvée');
        }

        $texte = sprintf(
            "Journal: %s\nHumeur: %d/10 - %s\nNote: %s",
            $entree->getDateSaisie()->format('d/m/Y'),
            $entree->getHumeur(),
            $entree->getLabelHumeur(),
            $entree->getNoteTextuelle() ?? ''
        );

        $qrCode = new QrCode($texte);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return new Response(
            $result->getString(),
            200,
            ['Content-Type' => 'image/png']
        );
    }

    #[Route('/export/pdf', name: 'export_pdf')]
    public function exportPdf(PdfExporter $pdfExporter): Response
    {
        $user = $this->security->getUser();

        if (!$user instanceof \App\Entity\User) {
            throw $this->createAccessDeniedException();
        }

        $entrees = $this->repo->findByUserId((int) $user->getId());

        $tmpFile = tempnam(sys_get_temp_dir(), 'journal') . '.pdf';
        $pdfExporter->exportJournal($entrees, $tmpFile);

        return $this->file($tmpFile, 'MonJournal.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }

    #[Route('/search', name: 'search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        $user = $this->security->getUser();

        if (!$user instanceof \App\Entity\User) {
            throw $this->createAccessDeniedException();
        }

        $userId    = (int) $user->getId();
        $keyword   = (string) $request->query->get('q', '');
        $date      = (string) $request->query->get('date', '');
        $humeurMin = $request->query->get('humeurMin') !== '' ? (int) $request->query->get('humeurMin') : null;
        $humeurMax = $request->query->get('humeurMax') !== '' ? (int) $request->query->get('humeurMax') : null;
        $sort      = (string) $request->query->get('sort', 'dateSaisie');
        $direction = (string) $request->query->get('direction', 'DESC');

        $entrees = $this->repo->searchAdvanced(
            $userId,
            $keyword,
            $date,
            null,
            $sort,
            $direction,
            $humeurMin,
            $humeurMax
        );

        $data = array_map(fn($e) => [
            'id'            => $e->getIdJournal(),
            'noteTextuelle' => $e->getNoteTextuelle() ?? 'Aucune note.',
            'humeur'        => $e->getHumeur(),
            'labelHumeur'   => $e->getLabelHumeur(),
            'emojiHumeur'   => $e->getEmojiHumeur(),
            'couleurHumeur' => $e->getCouleurHumeur(),
            'dateSaisie'    => $e->getDateSaisie()->format('d/m/Y'),
            'urlVoir'       => $this->generateUrl('entree_voir',      ['id' => $e->getIdJournal()]),
            'urlModifier'   => $this->generateUrl('entree_modifier',  ['id' => $e->getIdJournal()]),
            'urlSupprimer'  => $this->generateUrl('entree_supprimer', ['id' => $e->getIdJournal()]),
            'csrfToken'     => $this->csrfTokenManager->getToken('delete-entree-' . $e->getIdJournal())->getValue(),
        ], $entrees);

        return new JsonResponse($data);
    }
}