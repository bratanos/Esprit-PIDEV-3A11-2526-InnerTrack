<?php

namespace App\QrCodeBundle\Service;

use App\Entity\Journal\EntreeJournal;
use App\Entity\Journal\Habitude;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;

class QrCodeGenerator
{
    public function generatePng(string $texte): string
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($texte)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->build();

        return $result->getString();
    }

    public function generateBase64(string $texte): string
    {
        return 'data:image/png;base64,' . base64_encode($this->generatePng($texte));
    }

    public function buildHabitudeText(Habitude $habitude): string
    {
        return sprintf(
            "InnerTrack - Habitude\nNom: %s\nDate: %s\nEmotion: %s\nEnergie: %d/10\nStress: %d/10\nSommeil: %d/10\nNote: %s",
            $habitude->getNomHabitude(),
            $habitude->getDateCreation()->format('d/m/Y'),
            $habitude->getEmotionDominantes(),
            $habitude->getNiveauEnergie(),
            $habitude->getNiveauStress(),
            $habitude->getQualiteSommeil(),
            $habitude->getNoteTextuelle() ?? 'Aucune note.'
        );
    }

    public function buildJournalText(EntreeJournal $entree): string
    {
        return sprintf(
            "InnerTrack - Journal\nDate: %s\nHumeur: %d/10\nNote: %s",
            $entree->getDateSaisie()->format('d/m/Y'),
            $entree->getHumeur(),
            $entree->getNoteTextuelle() ?? 'Aucune note.'
        );
    }
}