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
    $user    = $this->security->getUser();
    $keyword = $request->query->get('q', '');
    $sortBy  = $request->query->get('sort', 'dateCreation');
    $order   = $request->query->get('order', 'DESC');

    $habitudes = $keyword
        ? $this->repo->search($keyword, $user->getId())
        : $this->repo->findByUserIdSorted($user->getId(), $sortBy, $order);

    $stats = $this->repo->getStatsByUserId($user->getId());

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
    $habitude = $this->repo->findOneBy(['idHabit' => $id]);

    if (!$habitude) {
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
    $user = $this->security->getUser();
    $habitudes = $this->repo->findByUserIdSorted($user->getId(), 'dateCreation', 'DESC');

    $tmpFile = tempnam(sys_get_temp_dir(), 'habitudes') . '.pdf';
    $pdfExporter->exportHabitudes($habitudes, $tmpFile);

    return $this->file($tmpFile, 'mes-habitudes.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
}
}