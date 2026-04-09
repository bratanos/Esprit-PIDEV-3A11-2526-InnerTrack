<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'community_reaction')]
class CommunityReaction
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: CommunityComment::class, inversedBy: 'reactions')]
    #[ORM\JoinColumn(name: 'comment_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private CommunityComment $comment;

    #[ORM\Column(length: 8, nullable: true)]
    private ?string $reaction = null;

    public function getUser(): User { return $this->user; }
    public function setUser(User $user): static { $this->user = $user; return $this; }

    public function getComment(): CommunityComment { return $this->comment; }
    public function setComment(CommunityComment $comment): static { $this->comment = $comment; return $this; }

    public function getReaction(): ?string { return $this->reaction; }
    public function setReaction(?string $reaction): static { $this->reaction = $reaction; return $this; }
}
