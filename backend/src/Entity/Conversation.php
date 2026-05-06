<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'conversation')]
class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /** @phpstan-ignore property.unusedType */
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private User $client;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'therapist_id', referencedColumnName: 'id', nullable: false)]
    private User $therapist;

    #[ORM\Column(length: 20, options: ['default' => 'PENDING'])]
    private string $status = 'PENDING';

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTimeInterface $createdAt;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'conversation')]
    private Collection $messages;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->messages  = new ArrayCollection();
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection { return $this->messages; }

    public function getId(): ?int { return $this->id; }
    public function getClient(): User { return $this->client; }
    public function setClient(User $client): self { $this->client = $client; return $this; }
    public function getTherapist(): User { return $this->therapist; }
    public function setTherapist(User $therapist): self { $this->therapist = $therapist; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getCreatedAt(): \DateTimeInterface { return $this->createdAt; }

    public function isActive(): bool { return $this->status === 'ACTIVE'; }

    public function getOtherUser(User $me): User
    {
        return $this->client->getId() === $me->getId() ? $this->therapist : $this->client;
    }
}