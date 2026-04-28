<?php

namespace App\Service\Journal;

use App\Entity\Journal\Habitude;

class HabitudeManager
{
    public function validate(Habitude $habitude): bool
    {
        //nom est obligatoire
        if (empty($habitude->getNomHabitude())) {
            throw new \InvalidArgumentException('Le nom de l\'habitude est obligatoire');
        }

        //niveaux doivent être entre 0 et 10
        if ($habitude->getNiveauEnergie() < 0 || $habitude->getNiveauEnergie() > 10) {
            throw new \InvalidArgumentException('Le niveau d\'énergie doit être entre 0 et 10');
        }

        if ($habitude->getNiveauStress() < 0 || $habitude->getNiveauStress() > 10) {
            throw new \InvalidArgumentException('Le niveau de stress doit être entre 0 et 10');
        }

        if ($habitude->getQualiteSommeil() < 0 || $habitude->getQualiteSommeil() > 10) {
            throw new \InvalidArgumentException('La qualité du sommeil doit être entre 0 et 10');
        }

        //date ne peut pas être dans le futur
        if ($habitude->getDateCreation() > new \DateTime()) {
            throw new \InvalidArgumentException('La date ne peut pas être dans le futur');
        }

        //L'émotion est obligatoire
        if (empty($habitude->getEmotionDominantes())) {
            throw new \InvalidArgumentException('L\'émotion dominante est obligatoire');
        }

        return true;
    }
}