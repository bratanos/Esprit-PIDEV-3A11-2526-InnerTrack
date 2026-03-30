<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'report')]
class Report
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'reporter_id', referencedColumnName: 'id', nullable: false)]
    private User $reporter;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'reported_id', referencedColumnName: 'id', nullable: false)]
    private User $reported;

    #[ORM\Column(length: 50)]
    private string $reason;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $details = null;

    #[ORM\Column(length: 20, options: ['default' => 'MESSAGING'])]
    private string $context = 'MESSAGING';

    #[ORM\Column(length: 20, options: ['default' => 'PENDING'])]
    private string $status = 'PENDING';

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(name: 'reviewed_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $reviewedAt = null;

    #[ORM\Column(name: 'reviewed_by', nullable: true)]
    private ?int $reviewedBy = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }
    public function getReporter(): User { return $this->reporter; }
    public function setReporter(User $reporter): self { $this->reporter = $reporter; return $this; }
    public function getReported(): User { return $this->reported; }
    public function setReported(User $reported): self { $this->reported = $reported; return $this; }
    public function getReason(): string { return $this->reason; }
    public function setReason(string $reason): self { $this->reason = $reason; return $this; }
    public function getDetails(): ?string { return $this->details; }
    public function setDetails(?string $details): self { $this->details = $details; return $this; }
    public function getContext(): string { return $this->context; }
    public function setContext(string $context): self { $this->context = $context; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getCreatedAt(): \DateTimeInterface { return $this->createdAt; }
    public function getReviewedAt(): ?\DateTimeInterface { return $this->reviewedAt; }
    public function setReviewedAt(?\DateTimeInterface $reviewedAt): self { $this->reviewedAt = $reviewedAt; return $this; }
    public function getReviewedBy(): ?int { return $this->reviewedBy; }
    public function setReviewedBy(?int $reviewedBy): self { $this->reviewedBy = $reviewedBy; return $this; }

    public function isPending(): bool { return $this->status === 'PENDING'; }

    public function getReasonLabel(): string
    {
        return match($this->reason) {
            'SPAM' => 'Spam',
            'HARASSMENT' => 'Harcèlement',
            'INAPPROPRIATE' => 'Contenu inapproprié',
            'OTHER' => 'Autre',
            default => $this->reason,
        };
    }
}
