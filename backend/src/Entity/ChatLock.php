<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'chat_lock')]
class ChatLock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private User $user;

    #[ORM\Column(length: 255)]
    private string $reason;

    #[ORM\Column(name: 'locked_at', type: 'datetime')]
    private \DateTimeInterface $lockedAt;

    #[ORM\Column(name: 'locked_until', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $lockedUntil = null;

    #[ORM\Column(name: 'locked_by')]
    private int $lockedBy;

    #[ORM\Column(name: 'is_active', type: 'boolean', options: ['default' => true])]
    private bool $isActive = true;

    public function __construct()
    {
        $this->lockedAt = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }
    public function getUser(): User { return $this->user; }
    public function setUser(User $user): self { $this->user = $user; return $this; }
    public function getReason(): string { return $this->reason; }
    public function setReason(string $reason): self { $this->reason = $reason; return $this; }
    public function getLockedAt(): \DateTimeInterface { return $this->lockedAt; }
    public function getLockedUntil(): ?\DateTimeInterface { return $this->lockedUntil; }
    public function setLockedUntil(?\DateTimeInterface $lockedUntil): self { $this->lockedUntil = $lockedUntil; return $this; }
    public function getLockedBy(): int { return $this->lockedBy; }
    public function setLockedBy(int $lockedBy): self { $this->lockedBy = $lockedBy; return $this; }
    public function isActive(): bool { return $this->isActive; }
    public function setIsActive(bool $isActive): self { $this->isActive = $isActive; return $this; }

    public function isPermanent(): bool { return $this->lockedUntil === null; }
}
