<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'user_settings')]
class UserSettings
{
    #[ORM\Id]
    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'settings')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private User $user;

    #[ORM\Column(length: 5, options: ['default' => 'LIGHT'])]
    private string $theme = 'LIGHT';

    #[ORM\Column(name: 'font_size', length: 6, options: ['default' => 'NORMAL'])]
    private string $fontSize = 'NORMAL';

    #[ORM\Column(length: 2, options: ['default' => 'FR'])]
    private string $language = 'FR';

    public function getUser(): User { return $this->user; }
    public function setUser(User $user): self { $this->user = $user; return $this; }
    public function getTheme(): string { return $this->theme; }
    public function setTheme(string $theme): self { $this->theme = $theme; return $this; }
    public function getFontSize(): string { return $this->fontSize; }
    public function setFontSize(string $fontSize): self { $this->fontSize = $fontSize; return $this; }
    public function getLanguage(): string { return $this->language; }
    public function setLanguage(string $language): self { $this->language = $language; return $this; }

    public function isDarkMode(): bool { return $this->theme === 'DARK'; }
}
