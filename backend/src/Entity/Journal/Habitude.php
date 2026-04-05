<?php

namespace App\Entity\Journal;

use App\Entity\User;
use App\Repository\Journal\HabitudeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HabitudeRepository::class)]
#[ORM\Table(name: 'habittracker')]
class Habitude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'Id_Habit', type: 'integer')]
    private ?int $idHabit = null;

    #[ORM\Column(name: 'nom_habitude', type: 'string', length: 255)]
    private string $nomHabitude;

    #[ORM\Column(name: 'emotion_dominantes', type: 'string', length: 255)]
    private string $emotionDominantes;

    #[ORM\Column(name: 'note_textuelle', type: 'text', nullable: true)]
    private ?string $noteTextuelle = null;

    #[ORM\Column(name: 'niveau_energie', type: 'integer')]
    private int $niveauEnergie;

    #[ORM\Column(name: 'niveau_stress', type: 'integer')]
    private int $niveauStress;

    #[ORM\Column(name: 'qualite_sommeil', type: 'integer')]
    private int $qualiteSommeil;

    #[ORM\Column(name: 'date_creation', type: 'date')]
    private \DateTimeInterface $dateCreation;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', nullable: false)]
    private User $user;

    #[ORM\ManyToOne(targetEntity: EntreeJournal::class)]
    #[ORM\JoinColumn(name: 'id_journal', referencedColumnName: 'id_journal', nullable: true)]
    private ?EntreeJournal $journal = null;

    // ── Getters & Setters ──────────────────────────────────────

    public function getIdHabit(): ?int { return $this->idHabit; }

    public function getNomHabitude(): string { return $this->nomHabitude; }
    public function setNomHabitude(string $v): self { $this->nomHabitude = $v; return $this; }

    public function getEmotionDominantes(): string { return $this->emotionDominantes; }
    public function setEmotionDominantes(string $v): self { $this->emotionDominantes = $v; return $this; }

    public function getNoteTextuelle(): ?string { return $this->noteTextuelle; }
    public function setNoteTextuelle(?string $v): self { $this->noteTextuelle = $v; return $this; }

    public function getNiveauEnergie(): int { return $this->niveauEnergie; }
    public function setNiveauEnergie(int $v): self { $this->niveauEnergie = $v; return $this; }

    public function getNiveauStress(): int { return $this->niveauStress; }
    public function setNiveauStress(int $v): self { $this->niveauStress = $v; return $this; }

    public function getQualiteSommeil(): int { return $this->qualiteSommeil; }
    public function setQualiteSommeil(int $v): self { $this->qualiteSommeil = $v; return $this; }

    public function getDateCreation(): \DateTimeInterface { return $this->dateCreation; }
    public function setDateCreation(\DateTimeInterface $v): self { $this->dateCreation = $v; return $this; }

    public function getUser(): User { return $this->user; }
    public function setUser(User $v): self { $this->user = $v; return $this; }

    public function getJournal(): ?EntreeJournal { return $this->journal; }
    public function setJournal(?EntreeJournal $v): self { $this->journal = $v; return $this; }

    // ── Helpers métier ─────────────────────────────────────────

    public function getCouleurEnergie(): string {
        return $this->niveauEnergie >= 7 ? '#48bb78' : ($this->niveauEnergie >= 4 ? '#f6ad55' : '#ff4444');
    }
    public function getEmojiEnergie(): string {
        return $this->niveauEnergie >= 7 ? '🟢' : ($this->niveauEnergie >= 4 ? '🟡' : '🔴');
    }
    public function getLabelEnergie(): string {
        return $this->niveauEnergie >= 7 ? 'Vitalité' : ($this->niveauEnergie >= 4 ? 'Moyenne' : 'Vide');
    }

    public function getCouleurStress(): string {
        return $this->niveauStress >= 7 ? '#ff4444' : ($this->niveauStress >= 4 ? '#f6ad55' : '#63b3ed');
    }
    public function getEmojiStress(): string {
        return $this->niveauStress >= 7 ? '🔴' : ($this->niveauStress >= 4 ? '🟡' : '🩵');
    }
    public function getLabelStress(): string {
        return $this->niveauStress >= 7 ? 'Alarme' : ($this->niveauStress >= 4 ? 'Tension' : 'Zen');
    }

    public function getCouleurSommeil(): string {
        return $this->qualiteSommeil >= 7 ? '#b794f4' : ($this->qualiteSommeil >= 4 ? '#4299e1' : '#a0aec0');
    }
    public function getEmojiSommeil(): string {
        return $this->qualiteSommeil >= 7 ? '💜' : ($this->qualiteSommeil >= 4 ? '🔵' : '🔘');
    }
    public function getLabelSommeil(): string {
        return $this->qualiteSommeil >= 7 ? 'Récupéré' : ($this->qualiteSommeil >= 4 ? 'Reposé' : 'Fatigué');
    }
}