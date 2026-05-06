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
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Service\PdfExporter;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

#[Route('/journal/habitude', name: 'habitude_')]
class HabitudeController extends AbstractController
{
    public function __construct(
        private HabitudeRepository        $repo,
        private EntityManagerInterface    $em,
        private Security                  $security,
        private CsrfTokenManagerInterface $csrfTokenManager
    ) {}

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->security->getUser();

        $keyword = (string) $request->query->get('q', '');
        $sortBy  = (string) $request->query->get('sort', 'dateCreation');
        $order   = (string) $request->query->get('order', 'DESC');

        $userId = (int) $user->getId();
        $habitudes = $keyword
            ? $this->repo->search($keyword, $userId)
            : $this->repo->findByUserIdSorted($userId, $sortBy, $order);
        $stats = $this->repo->getStatsByUserId($userId);

        return $this->render('journal/habitude/index.html.twig', [
            'habitudes' => $habitudes,
            'keyword'   => $keyword,
            'stats'     => $stats,
            'sortBy'    => $sortBy,
            'order'     => $order,
        ]);
    }

    #[Route('/ajouter', name: 'ajouter')]
    public function ajouter(Request $request): Response
    {
        $habitude = new Habitude();
        $habitude->setDateCreation(new \DateTime());
        $form     = $this->createForm(HabitudeType::class, $habitude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\User $user */
            $user = $this->security->getUser();
            $habitude->setUser($user);
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
        if ($this->isCsrfTokenValid('delete-habitude-' . $habitude->getIdHabit(), (string) $request->request->get('_token'))) {
            $this->em->remove($habitude);
            $this->em->flush();
            $this->addFlash('success', '✅ Habitude supprimée !');
        }
        return $this->redirectToRoute('habitude_index');
    }

    #[Route('/voir/{id}', name: 'voir')]
    public function voir(int $id): Response
    {
        $habitude = $this->repo->find($id);
        if (!$habitude) {
            throw $this->createNotFoundException('Habitude non trouvée');
        }
        return $this->render('journal/habitude/voir.html.twig', [
            'habitude' => $habitude,
        ]);
    }

    #[Route('/qrcode/{id}', name: 'qrcode')]
    public function qrcode(int $id): Response
    {
        /** @var Habitude|null $habitude */
        $habitude = $this->repo->findOneBy(['idHabit' => $id]);

        if (!$habitude instanceof Habitude) {
            throw $this->createNotFoundException('Habitude non trouvée');
        }

        $texte = sprintf(
            "Habitude: %s\nDate: %s\nEmotion: %s\nEnergie: %d/10\nStress: %d/10\nSommeil: %d/10\nNote: %s",
            $habitude->getNomHabitude(),
            $habitude->getDateCreation()->format('d/m/Y'),
            $habitude->getEmotionDominantes(),
            $habitude->getNiveauEnergie(),
            $habitude->getNiveauStress(),
            $habitude->getQualiteSommeil(),
            $habitude->getNoteTextuelle() ?? ''
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
        /** @var \App\Entity\User $user */
        $user = $this->security->getUser();
        $habitudes = $this->repo->findByUserIdSorted((int) $user->getId(), 'dateCreation', 'DESC');

        $tmpFile = tempnam(sys_get_temp_dir(), 'habitudes') . '.pdf';
        $pdfExporter->exportHabitudes($habitudes, $tmpFile);

        return $this->file($tmpFile, 'mes-habitudes.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }

    #[Route('/search', name: 'search', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user = $this->security->getUser();
        $keyword    = (string) $request->query->get('q', '');
        $emotion    = (string) $request->query->get('emotion', '');
        $energieMin = $request->query->get('energieMin') !== '' ? (int) $request->query->get('energieMin') : null;
        $energieMax = $request->query->get('energieMax') !== '' ? (int) $request->query->get('energieMax') : null;
        $stressMax  = $request->query->get('stressMax')  !== '' ? (int) $request->query->get('stressMax')  : null;
        $date       = (string) $request->query->get('date', '');
        $sort       = (string) $request->query->get('sort', 'dateCreation');
        $order      = (string) $request->query->get('order', 'DESC');
        $habitudes  = $this->repo->searchAdvanced(
            (int) $user->getId(), $keyword, $emotion, $energieMin, $energieMax, $stressMax, $date, $sort, $order
        );

        $data = array_map(fn($h) => [
            'id'              => $h->getIdHabit(),
            'nomHabitude'     => $h->getNomHabitude(),
            'emotionDominantes' => $h->getEmotionDominantes(),
            'niveauEnergie'   => $h->getNiveauEnergie(),
            'niveauStress'    => $h->getNiveauStress(),
            'qualiteSommeil'  => $h->getQualiteSommeil(),
            'dateCreation'    => $h->getDateCreation()->format('d/m/Y'),
            'labelEnergie'    => $h->getLabelEnergie(),
            'labelStress'     => $h->getLabelStress(),
            'labelSommeil'    => $h->getLabelSommeil(),
            'couleurEnergie'  => $h->getCouleurEnergie(),
            'couleurStress'   => $h->getCouleurStress(),
            'couleurSommeil'  => $h->getCouleurSommeil(),
            'emojiEnergie'    => $h->getEmojiEnergie(),
            'emojiStress'     => $h->getEmojiStress(),
            'emojiSommeil'    => $h->getEmojiSommeil(),
            'urlVoir'         => $this->generateUrl('habitude_voir',     ['id' => $h->getIdHabit()]),
            'urlModifier'     => $this->generateUrl('habitude_modifier', ['id' => $h->getIdHabit()]),
            'urlSupprimer'    => $this->generateUrl('habitude_supprimer',['id' => $h->getIdHabit()]),
            'csrfToken'       => $this->csrfTokenManager->getToken('delete-habitude-' . $h->getIdHabit())->getValue(),
        ], $habitudes);

        return new JsonResponse($data);
    }
}