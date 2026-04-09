<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
#[ORM\Table(name: 'inscription')]
class Inscription
{
    public const STATUS_CONFIRMED = 'CONFIRMÉ';
    public const STATUS_WAITING = 'EN_ATTENTE';
    public const STATUS_CANCELLED = 'ANNULÉ';


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_inscription', type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'inscriptions')]
    #[ORM\JoinColumn(name: 'id_evenement', referencedColumnName: 'id_event', nullable: false)]
    private ?Event $evenement = null;

    #[ORM\Column(name: 'nom_participant', type: Types::STRING, length: 255)]
    #[Assert\Length(min: 2, max: 255, minMessage: 'Le nom doit faire au moins 2 caractères')]
    private ?string $nomParticipant = null;

    #[ORM\Column(name: 'email_participant', type: Types::STRING, length: 255)]
    #[Assert\Email(message: "L'adresse email '{{ value }}' n'est pas valide")]
    private ?string $emailParticipant = null;

    #[ORM\Column(name: 'date_inscription', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(name: 'statut', type: Types::STRING, length: 50)]
    private string $statut = self::STATUS_CONFIRMED;

    public function __construct()
    {
        $this->dateInscription = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }

    public function getEvenement(): ?Event { return $this->evenement; }
    public function setEvenement(?Event $evenement): static { $this->evenement = $evenement; return $this; }

    public function getNomParticipant(): ?string { return $this->nomParticipant; }
    public function setNomParticipant(string $n): static { $this->nomParticipant = $n; return $this; }

    public function getEmailParticipant(): ?string { return $this->emailParticipant; }
    public function setEmailParticipant(string $e): static { $this->emailParticipant = $e; return $this; }

    public function getDateInscription(): ?\DateTimeInterface { return $this->dateInscription; }
    public function setDateInscription(\DateTimeInterface $d): static { $this->dateInscription = $d; return $this; }

    public function getStatut(): string { return $this->statut; }
    public function setStatut(string $s): static { $this->statut = $s; return $this; }
}
