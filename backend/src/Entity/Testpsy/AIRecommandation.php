<?php

namespace App\Entity\Testpsy;

class AIRecommandation
{
    private ?string $cluster = null;
<<<<<<< HEAD
    private array $probabilites = [];
    private int $scoreConfiance = 0;
    private array $features = [];
    private ?string $analyseGlobale = null;
    private array $habitudes = [];
    private ?string $planSemaine = null;
    private array $alertes = [];

    public function getCluster(): ?string { return $this->cluster; }
    public function setCluster(?string $v): self { $this->cluster = $v; return $this; }
    public function getProbabilites(): array { return $this->probabilites; }
    public function setProbabilites(array $v): self { $this->probabilites = $v; return $this; }
    public function getScoreConfiance(): int { return $this->scoreConfiance; }
    public function setScoreConfiance(int $v): self { $this->scoreConfiance = $v; return $this; }
    public function getFeatures(): array { return $this->features; }
    public function setFeatures(array $v): self { $this->features = $v; return $this; }
    public function getAnalyseGlobale(): ?string { return $this->analyseGlobale; }
    public function setAnalyseGlobale(?string $v): self { $this->analyseGlobale = $v; return $this; }
    public function getHabitudes(): array { return $this->habitudes; }
    public function setHabitudes(array $v): self { $this->habitudes = $v; return $this; }
    public function getPlanSemaine(): ?string { return $this->planSemaine; }
    public function setPlanSemaine(?string $v): self { $this->planSemaine = $v; return $this; }
    public function getAlertes(): array { return $this->alertes; }
    public function setAlertes(array $v): self { $this->alertes = $v; return $this; }

    private array $votesModeles = [];
private array $analyseFeatures = [];
private string $niveauConfiance = '';

public function getVotesModeles(): array { return $this->votesModeles; }
public function setVotesModeles(array $v): self { $this->votesModeles = $v; return $this; }
public function getAnalyseFeatures(): array { return $this->analyseFeatures; }
public function setAnalyseFeatures(array $v): self { $this->analyseFeatures = $v; return $this; }
public function getNiveauConfiance(): string { return $this->niveauConfiance; }
public function setNiveauConfiance(string $v): self { $this->niveauConfiance = $v; return $this; }
=======

    /** @var array<int, float> */
    private array $probabilites = [];

    private int $scoreConfiance = 0;

    /** @var array<int, float> */
    private array $features = [];

    private ?string $analyseGlobale = null;

    /** @var array<int, array<string, string>> */
    private array $habitudes = [];

    private ?string $planSemaine = null;

    /** @var array<int, string> */
    private array $alertes = [];

    /** @var array<int, array<string, string>> */
    private array $votesModeles = [];

    /** @var array<int, array<string, mixed>> */
    private array $analyseFeatures = [];

    private string $niveauConfiance = '';

    public function getCluster(): ?string { return $this->cluster; }
    public function setCluster(?string $v): self { $this->cluster = $v; return $this; }

    /** @return array<int, float> */
    public function getProbabilites(): array { return $this->probabilites; }
    /** @param array<int, float> $v */
    public function setProbabilites(array $v): self { $this->probabilites = $v; return $this; }

    public function getScoreConfiance(): int { return $this->scoreConfiance; }
    public function setScoreConfiance(int $v): self { $this->scoreConfiance = $v; return $this; }

    /** @return array<int, float> */
    public function getFeatures(): array { return $this->features; }
    /** @param array<int, float> $v */
    public function setFeatures(array $v): self { $this->features = $v; return $this; }

    public function getAnalyseGlobale(): ?string { return $this->analyseGlobale; }
    public function setAnalyseGlobale(?string $v): self { $this->analyseGlobale = $v; return $this; }

    /** @return array<int, array<string, string>> */
    public function getHabitudes(): array { return $this->habitudes; }
    /** @param array<int, array<string, string>> $v */
    public function setHabitudes(array $v): self { $this->habitudes = $v; return $this; }

    public function getPlanSemaine(): ?string { return $this->planSemaine; }
    public function setPlanSemaine(?string $v): self { $this->planSemaine = $v; return $this; }

    /** @return array<int, string> */
    public function getAlertes(): array { return $this->alertes; }
    /** @param array<int, string> $v */
    public function setAlertes(array $v): self { $this->alertes = $v; return $this; }

    /** @return array<int, array<string, string>> */
    public function getVotesModeles(): array { return $this->votesModeles; }
    /** @param array<int, array<string, string>> $v */
    public function setVotesModeles(array $v): self { $this->votesModeles = $v; return $this; }

    /** @return array<int, array<string, mixed>> */
    public function getAnalyseFeatures(): array { return $this->analyseFeatures; }
    /** @param array<int, array<string, mixed>> $v */
    public function setAnalyseFeatures(array $v): self { $this->analyseFeatures = $v; return $this; }

    public function getNiveauConfiance(): string { return $this->niveauConfiance; }
    public function setNiveauConfiance(string $v): self { $this->niveauConfiance = $v; return $this; }
>>>>>>> origin/feature/salma-TestSymphony+java

    public function getCouleurCluster(): string
    {
        return match($this->cluster) {
            'Fragile'   => '#e74c3c',
            'Stable'    => '#f39c12',
            'Résilient' => '#27ae60',
            default     => '#888888',
        };
    }

    public function getEmojiCluster(): string
    {
        return match($this->cluster) {
            'Fragile'   => '🔴',
            'Stable'    => '🟡',
            'Résilient' => '🟢',
            default     => '❓',
        };
    }
}