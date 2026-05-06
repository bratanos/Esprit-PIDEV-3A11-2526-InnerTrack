<?php

namespace App\QrCodeBundle\Controller;

use App\QrCodeBundle\Service\QrCodeGenerator;
use App\Repository\Journal\HabitudeRepository;
use App\Repository\Journal\EntreeJournalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/qrcode', name: 'qrcode_')]
class QrCodeController extends AbstractController
{
    public function __construct(
        private QrCodeGenerator         $generator,
        private HabitudeRepository      $habitudeRepo,
        private EntreeJournalRepository $entreeRepo,
    ) {}

    #[Route('/habitude/{id}', name: 'habitude_detail')]
    public function habitudeDetail(int $id): Response
    {
        $habitude = $this->habitudeRepo->findOneBy(['idHabit' => $id]);
        if (!$habitude) {
            throw $this->createNotFoundException('Habitude non trouvée');
        }

        $texte    = $this->generator->buildHabitudeText($habitude);
        $qrBase64 = $this->generator->generateBase64($texte);

        return $this->render('qrcode/detail_habitude.html.twig', [
            'habitude' => $habitude,
            'qrBase64' => $qrBase64,
        ]);
    }

    #[Route('/habitude/{id}/png', name: 'habitude_png')]
    public function habitudePng(int $id): Response
    {
        $habitude = $this->habitudeRepo->findOneBy(['idHabit' => $id]);
        if (!$habitude) {
            throw $this->createNotFoundException('Habitude non trouvée');
        }

        $texte = $this->generator->buildHabitudeText($habitude);

        return new Response(
            $this->generator->generatePng($texte),
            200,
            ['Content-Type' => 'image/png']
        );
    }

    #[Route('/journal/{id}', name: 'journal_detail')]
    public function journalDetail(int $id): Response
    {
        $entree = $this->entreeRepo->findOneBy(['idJournal' => $id]);
        if (!$entree) {
            throw $this->createNotFoundException('Entrée non trouvée');
        }

        $texte    = $this->generator->buildJournalText($entree);
        $qrBase64 = $this->generator->generateBase64($texte);

        return $this->render('qrcode/detail_journal.html.twig', [
            'entree'   => $entree,
            'qrBase64' => $qrBase64,
        ]);
    }

    #[Route('/journal/{id}/png', name: 'journal_png')]
    public function journalPng(int $id): Response
    {
        $entree = $this->entreeRepo->findOneBy(['idJournal' => $id]);
        if (!$entree) {
            throw $this->createNotFoundException('Entrée non trouvée');
        }

        $texte = $this->generator->buildJournalText($entree);

        return new Response(
            $this->generator->generatePng($texte),
            200,
            ['Content-Type' => 'image/png']
        );
    }
}