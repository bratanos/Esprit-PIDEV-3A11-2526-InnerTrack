<?php

namespace App\Entity\Testpsy;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'test_psychologique')]
class TestPsychologique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_test', type: 'integer')]
    /** @phpstan-ignore property.onlyRead */
    private int $idTest;

    #[ORM\Column(name: 'titre', type: 'string', length: 255)]
    private string $titre;

    #[ORM\Column(name: 'id_type', type: 'integer')]
    private int $idType;

    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'nombre_questions', type: 'integer')]
    private int $nombreQuestions;

    /** @var Collection<int, Question> */
    #[ORM\OneToMany(mappedBy: 'test', targetEntity: Question::class)]
    private Collection $questions;

    /** @var Collection<int, TrancheResultat> */
    #[ORM\OneToMany(mappedBy: 'test', targetEntity: TrancheResultat::class)]
    private Collection $tranches;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->tranches  = new ArrayCollection();
    }

    public function getIdTest(): int { return $this->idTest; }
    public function getTitre(): string { return $this->titre; }
    public function setTitre(string $titre): self { $this->titre = $titre; return $this; }
    public function getIdType(): int { return $this->idType; }
    public function setIdType(int $idType): self { $this->idType = $idType; return $this; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function getNombreQuestions(): int { return $this->nombreQuestions; }
    public function setNombreQuestions(int $n): self { $this->nombreQuestions = $n; return $this; }

    /** @return Collection<int, Question> */
    public function getQuestions(): Collection { return $this->questions; }

    /** @return Collection<int, TrancheResultat> */
    public function getTranches(): Collection { return $this->tranches; }
}