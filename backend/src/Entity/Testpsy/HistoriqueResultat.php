<?php

namespace App\Entity\Testpsy;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'historique_resultat')]
class HistoriqueResultat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_historique', type: 'integer')]
    private int $idHistorique;

    #[ORM\Column(name: 'id_utilisateur', type: 'integer')]
    private int $idUser;

    #[ORM\Column(name: 'id_test', type: 'integer')]
    private int $idTest;

    #[ORM\Column(name: 'score', type: 'integer', nullable: true)]
    private ?int $score = null;

    #[ORM\Column(name: 'pourcentage', type: 'float', nullable: true)]
    private ?float $pourcentage = null;

    #[ORM\Column(name: 'niveau', type: 'string', length: 100, nullable: true)]
    private ?string $niveau = null;

    #[ORM\Column(name: 'date_passage', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $datePassage = null;

    public function getIdHistorique(): int { return $this->idHistorique; }
    public function getIdUser(): int { return $this->idUser; }
    public function setIdUser(int $v): self { $this->idUser = $v; return $this; }
    public function getIdTest(): int { return $this->idTest; }
    public function setIdTest(int $v): self { $this->idTest = $v; return $this; }
    public function getScore(): ?int { return $this->score; }
    public function setScore(?int $v): self { $this->score = $v; return $this; }
    public function getPourcentage(): ?float { return $this->pourcentage; }
    public function setPourcentage(?float $v): self { $this->pourcentage = $v; return $this; }
    public function getNiveau(): ?string { return $this->niveau; }
    public function setNiveau(?string $v): self { $this->niveau = $v; return $this; }
    public function getDatePassage(): ?\DateTimeInterface { return $this->datePassage; }
    public function setDatePassage(?\DateTimeInterface $v): self { $this->datePassage = $v; return $this; }
}