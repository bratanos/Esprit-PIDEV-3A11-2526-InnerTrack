<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'blocked_user')]
class BlockedUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private User $client;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'therapist_id', referencedColumnName: 'id', nullable: false)]
    private User $therapist;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }
    public function getClient(): User { return $this->client; }
    public function setClient(User $client): self { $this->client = $client; return $this; }
    public function getTherapist(): User { return $this->therapist; }
    public function setTherapist(User $therapist): self { $this->therapist = $therapist; return $this; }
    public function getCreatedAt(): \DateTimeInterface { return $this->createdAt; }
}
