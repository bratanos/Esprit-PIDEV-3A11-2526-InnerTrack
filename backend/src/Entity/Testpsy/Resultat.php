<?php

namespace App\Entity\Testpsy;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'resultat')]
class Resultat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_resultat', type: 'integer')]
    private int $idResultat;

    #[ORM\Column(name: 'id_test', type: 'integer')]
    private int $idTest;

    #[ORM\Column(name: 'id_utilisateur', type: 'integer')]
    private int $idUtilisateur;

    #[ORM\Column(name: 'score_total', type: 'integer')]
    private int $scoreTotal;

    #[ORM\Column(name: 'score_max_possible', type: 'integer')]
    private int $scoreMaxPossible;

    #[ORM\Column(name: 'pourcentage', type: 'float')]
    private float $pourcentage;

    #[ORM\Column(name: 'resultat', type: 'string', length: 255, nullable: false, options: ['default' => 'Non évalué'])]
    private string $resultat = 'Non évalué';

    #[ORM\Column(name: 'interpretation', type: 'text', nullable: true)]
    private ?string $interpretation = null;

    #[ORM\Column(name: 'date_passage', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $datePassage = null;

    public function getIdResultat(): int { return $this->idResultat; }

    public function getIdTest(): int { return $this->idTest; }
    public function setIdTest(int $v): self { $this->idTest = $v; return $this; }

    public function getIdUtilisateur(): int { return $this->idUtilisateur; }
    public function setIdUtilisateur(int $v): self { $this->idUtilisateur = $v; return $this; }

    public function getScoreTotal(): int { return $this->scoreTotal; }
    public function setScoreTotal(int $v): self { $this->scoreTotal = $v; return $this; }

    public function getScoreMaxPossible(): int { return $this->scoreMaxPossible; }
    public function setScoreMaxPossible(int $v): self { $this->scoreMaxPossible = $v; return $this; }

    public function getPourcentage(): float { return $this->pourcentage; }
    public function setPourcentage(float $v): self { $this->pourcentage = $v; return $this; }

    public function getResultat(): string { return $this->resultat; }
    public function setResultat(string $v): self { $this->resultat = $v; return $this; }

    public function getInterpretation(): ?string { return $this->interpretation; }
    public function setInterpretation(?string $v): self { $this->interpretation = $v; return $this; }

    public function getDatePassage(): ?\DateTimeInterface { return $this->datePassage; }
    public function setDatePassage(?\DateTimeInterface $v): self { $this->datePassage = $v; return $this; }
}