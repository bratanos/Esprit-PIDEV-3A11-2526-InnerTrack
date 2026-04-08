<?php

namespace App\Entity\Testpsy;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'type_test')]
class TypeTest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_type', type: 'integer')]
    private int $idType;

    #[ORM\Column(name: 'libelle', type: 'string', length: 255)]
    private string $libelle;

    public function getIdType(): int { return $this->idType; }
    public function getLibelle(): string { return $this->libelle; }
    public function setLibelle(string $libelle): self { $this->libelle = $libelle; return $this; }
}