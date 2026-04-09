<?php

namespace App\Entity\Testpsy;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'question')]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_question', type: 'integer')]
    private int $idQuestion;

    #[ORM\ManyToOne(targetEntity: TestPsychologique::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(name: 'id_test', referencedColumnName: 'id_test')]
    private TestPsychologique $test;

    #[ORM\Column(name: 'contenu', type: 'text')]
    private string $contenu;

    public function getIdQuestion(): int { return $this->idQuestion; }
    public function getTest(): TestPsychologique { return $this->test; }
    public function setTest(TestPsychologique $test): self { $this->test = $test; return $this; }
    public function getContenu(): string { return $this->contenu; }
    public function setContenu(string $contenu): self { $this->contenu = $contenu; return $this; }
}