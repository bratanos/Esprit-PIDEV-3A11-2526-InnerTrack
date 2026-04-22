<?php

namespace App\Entity\Journal;

use App\Entity\User;
use App\Repository\Journal\EntreeJournalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntreeJournalRepository::class)]
#[ORM\Table(name: 'journalemotionelle')]
class EntreeJournal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_journal', type: 'integer')]
    private ?int $idJournal = null;

    #[ORM\Column(name: 'humeur', type: 'integer')]
    private int $humeur = 5;

    #[ORM\Column(name: 'note_textuelle', type: 'text', nullable: true)]
    private ?string $noteTextuelle = null;

    #[ORM\Column(name: 'date_saisie', type: 'date')]
    private \DateTimeInterface $dateSaisie;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', nullable: false)]
    private User $user;

    //Getters & Setters

    public function getIdJournal(): ?int { return $this->idJournal; }

    public function getHumeur(): int { return $this->humeur; }
    public function setHumeur(int $v): self { $this->humeur = $v; return $this; }

    public function getNoteTextuelle(): ?string { return $this->noteTextuelle; }
    public function setNoteTextuelle(?string $v): self { $this->noteTextuelle = $v; return $this; }

    public function getDateSaisie(): \DateTimeInterface { return $this->dateSaisie; }
    public function setDateSaisie(\DateTimeInterface $v): self { $this->dateSaisie = $v; return $this; }

    public function getUser(): User { return $this->user; }
    public function setUser(User $v): self { $this->user = $v; return $this; }

    // Helpers métier

    public function getEmojiHumeur(): string {
        return match(true) {
            $this->humeur >= 9 => '😄',
            $this->humeur >= 7 => '🙂',
            $this->humeur >= 5 => '😐',
            $this->humeur >= 3 => '😔',
            default            => '😢',
        };
    }

    public function getLabelHumeur(): string {
        return match(true) {
            $this->humeur >= 9 => 'Excellent',
            $this->humeur >= 7 => 'Bien',
            $this->humeur >= 5 => 'Neutre',
            $this->humeur >= 3 => 'Difficile',
            default            => 'Très difficile',
        };
    }

    public function getCouleurHumeur(): string {
        return match(true) {
            $this->humeur >= 9 => '#48bb78',
            $this->humeur >= 7 => '#68d391',
            $this->humeur >= 5 => '#f6ad55',
            $this->humeur >= 3 => '#fc8181',
            default            => '#ff4444',
        };
    }
}