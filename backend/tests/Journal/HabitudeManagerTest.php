<?php

namespace App\Tests\Service\Journal;

use App\Entity\Journal\Habitude;
use App\Service\Journal\HabitudeManager;
use PHPUnit\Framework\TestCase;

class HabitudeManagerTest extends TestCase
{
    private HabitudeManager $manager;

    protected function setUp(): void
    {
        $this->manager = new HabitudeManager();
    }

    //TEST 1 : Habitude valide
    public function testHabitudeValide(): void
    {
        $habitude = new Habitude();
        $habitude->setNomHabitude('Méditation');
        $habitude->setEmotionDominantes('Calme');
        $habitude->setNiveauEnergie(7);
        $habitude->setNiveauStress(2);
        $habitude->setQualiteSommeil(8);
        $habitude->setDateCreation(new \DateTime());

        $this->assertTrue($this->manager->validate($habitude));
    }

    //TEST 2 : Nom vide 
    public function testNomObligatoire(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom de l\'habitude est obligatoire');

        $habitude = new Habitude();
        $habitude->setNomHabitude('');
        $habitude->setEmotionDominantes('Joie');
        $habitude->setNiveauEnergie(5);
        $habitude->setNiveauStress(5);
        $habitude->setQualiteSommeil(5);
        $habitude->setDateCreation(new \DateTime());

        $this->manager->validate($habitude);
    }

    //TEST 3 : Énergie hors limites
    public function testNiveauEnergieInvalide(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le niveau d\'énergie doit être entre 0 et 10');

        $habitude = new Habitude();
        $habitude->setNomHabitude('Sport');
        $habitude->setEmotionDominantes('Énergie');
        $habitude->setNiveauEnergie(15);
        $habitude->setNiveauStress(5);
        $habitude->setQualiteSommeil(5);
        $habitude->setDateCreation(new \DateTime());

        $this->manager->validate($habitude);
    }

    //TEST 4 : Date dans le futur 
    public function testDateFutureInvalide(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('La date ne peut pas être dans le futur');

        $habitude = new Habitude();
        $habitude->setNomHabitude('Lecture');
        $habitude->setEmotionDominantes('Calme');
        $habitude->setNiveauEnergie(5);
        $habitude->setNiveauStress(3);
        $habitude->setQualiteSommeil(7);
        $habitude->setDateCreation(new \DateTime('+1 month')); 

        $this->manager->validate($habitude);
    }

    //TEST 5 : Émotion vide 
    public function testEmotionObligatoire(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('L\'émotion dominante est obligatoire');

        $habitude = new Habitude();
        $habitude->setNomHabitude('Yoga');
        $habitude->setEmotionDominantes('');
        $habitude->setNiveauEnergie(6);
        $habitude->setNiveauStress(4);
        $habitude->setQualiteSommeil(7);
        $habitude->setDateCreation(new \DateTime());

        $this->manager->validate($habitude);
    }
}