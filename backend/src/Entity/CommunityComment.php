<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'community_comment')]
class CommunityComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private User $user;

    #[ORM\Column(length: 500)]
    private string $content;

    #[ORM\Column(name: 'created_at')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private bool $modified = false;

    #[ORM\ManyToOne(targetEntity: CommunityComment::class, inversedBy: 'replies')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    private ?CommunityComment $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: CommunityComment::class, cascade: ['remove'])]
    private Collection $replies;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'comment', targetEntity: CommunityReaction::class, cascade: ['remove'])]
    private Collection $reactions;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
        $this->reactions = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }

    public function getUser(): User { return $this->user; }
    public function setUser(User $user): static { $this->user = $user; return $this; }

    public function getContent(): string { return $this->content; }
    public function setContent(string $content): static { $this->content = $content; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(\DateTimeImmutable $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function isModified(): bool { return $this->modified; }
    public function setModified(bool $modified): static { $this->modified = $modified; return $this; }

    public function getParent(): ?CommunityComment { return $this->parent; }
    public function setParent(?CommunityComment $parent): static { $this->parent = $parent; return $this; }

    public function getReplies(): Collection { return $this->replies; }

    public function getTitle(): ?string { return $this->title; }
    public function setTitle(?string $title): static { $this->title = $title; return $this; }

    public function getReactions(): Collection { return $this->reactions; }

    public function isReply(): bool { return $this->parent !== null; }

    public function getReactionCounts(): array
    {
        $counts = [];
        foreach ($this->reactions as $reaction) {
            $emoji = $reaction->getReaction();
            $counts[$emoji] = ($counts[$emoji] ?? 0) + 1;
        }
        return $counts;
    }

    public function getUserReaction(int $userId): ?string
    {
        foreach ($this->reactions as $reaction) {
            if ($reaction->getUser()->getId() === $userId) {
                return $reaction->getReaction();
            }
        }
        return null;
    }
}
