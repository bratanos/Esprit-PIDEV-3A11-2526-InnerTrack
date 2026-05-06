<?php

namespace App\QrCodeBundle\Service;

use App\Entity\Journal\EntreeJournal;
use App\Entity\Journal\Habitude;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeGenerator
{
    public function generatePng(string $texte): string
    {
        $qrCode = new QrCode($texte);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
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