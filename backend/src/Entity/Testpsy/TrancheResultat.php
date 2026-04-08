<?php

namespace App\Entity\Testpsy;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tranche_resultat')]
class TrancheResultat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_tranche', type: 'integer')]
    private int $idTranche;

    #[ORM\ManyToOne(targetEntity: TestPsychologique::class, inversedBy: 'tranches')]
    #[ORM\JoinColumn(name: 'id_test', referencedColumnName: 'id_test')]
    private TestPsychologique $test;

    #[ORM\Column(name: 'score_min', type: 'integer')]
    private int $scoreMin;

    #[ORM\Column(name: 'score_max', type: 'integer')]
    private int $scoreMax;

    #[ORM\Column(name: 'libelle', type: 'string', length: 255)]
    private string $libelle;

    #[ORM\Column(name: 'interpretation', type: 'text', nullable: true)]
    private ?string $interpretation = null;

    #[ORM\Column(name: 'niveau', type: 'string', length: 50, nullable: true)]
    private ?string $niveau = null;

    public function getIdTranche(): int { return $this->idTranche; }

    public function getTest(): TestPsychologique { return $this->test; }
    public function setTest(TestPsychologique $test): self { $this->test = $test; return $this; }

    public function getScoreMin(): int { return $this->scoreMin; }
    public function setScoreMin(int $v): self { $this->scoreMin = $v; return $this; }

    public function getScoreMax(): int { return $this->scoreMax; }
    public function setScoreMax(int $v): self { $this->scoreMax = $v; return $this; }

    public function getLibelle(): string { return $this->libelle; }
    public function setLibelle(string $v): self { $this->libelle = $v; return $this; }

    public function getInterpretation(): ?string { return $this->interpretation; }
    public function setInterpretation(?string $v): self { $this->interpretation = $v; return $this; }

    public function getNiveau(): ?string { return $this->niveau; }
    public function setNiveau(?string $v): self { $this->niveau = $v; return $this; }
}