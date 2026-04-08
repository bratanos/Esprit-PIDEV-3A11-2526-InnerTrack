<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'event')]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_event', type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(name: 'titre', type: Types::STRING, length: 255)]
    #[Assert\Length(min: 2, max: 255, minMessage: 'Le titre doit faire au moins 2 caractères', maxMessage: 'Le titre ne peut pas dépasser 255 caractères')]
    private ?string $titre = null;

    #[ORM\Column(name: 'description', type: Types::TEXT, nullable: true)]
    #[Assert\Length(min: 10, minMessage: 'La description doit faire au moins 10 caractères si elle est renseignée')]
    private ?string $description = null;

    #[ORM\Column(name: 'date_event', type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThanOrEqual("today", message: "La date de l'événement ne peut pas être dans le passé")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(name: 'id_type_event', type: Types::INTEGER, enumType: TypeEvent::class)]
    private ?TypeEvent $type = null;

    #[ORM\Column(name: 'date_creation', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(name: 'capacite', type: Types::INTEGER)]
    #[Assert\Positive(message: "La capacité doit être un nombre positif (1 ou plus)")]
    private ?int $capacite = null;

    #[ORM\Column(name: 'statut', type: Types::BOOLEAN)]
    private bool $statut = true;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: Inscription::class, cascade: ['persist', 'remove'])]
    private Collection $inscriptions;

    public function __construct()
    {
        $this->inscriptions  = new ArrayCollection();
        $this->dateCreation  = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }

    public function getTitre(): ?string { return $this->titre; }
    public function setTitre(string $titre): static { $this->titre = $titre; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }

    public function getDate(): ?\DateTimeInterface { return $this->date; }
    public function setDate(\DateTimeInterface $date): static { $this->date = $date; return $this; }

    public function getType(): ?TypeEvent { return $this->type; }
    public function setType(TypeEvent $type): static { $this->type = $type; return $this; }

    public function getDateCreation(): ?\DateTimeInterface { return $this->dateCreation; }
    public function setDateCreation(\DateTimeInterface $d): static { $this->dateCreation = $d; return $this; }

    public function getCapacite(): ?int { return $this->capacite; }
    public function setCapacite(int $capacite): static { $this->capacite = $capacite; return $this; }

    public function isStatut(): bool { return $this->statut; }
    public function setStatut(bool $statut): static { $this->statut = $statut; return $this; }

    public function getInscriptions(): Collection { return $this->inscriptions; }
}
