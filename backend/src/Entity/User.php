<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: \App\Repository\UserRepository::class)]
#[ORM\Table(name: 'user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /** @phpstan-ignore property.unusedType */
    private ?int $id = null;

    #[ORM\Column(unique: true)]
    private string $email;

    #[ORM\Column]
    private string $password;

    #[ORM\Column(length: 20)]
    private string $status = 'PENDING';

    /**
     * @var string[]
     */
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(name: 'is_verified')]
    private bool $isVerified = false;

    #[ORM\Column(name: 'first_name', length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(name: 'last_name', length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(name: 'profile_picture', length: 255, nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'last_login', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $lastLogin = null;

    #[ORM\Column(name: 'phone_number', length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    /**
     * @var Collection<int, EmailVerificationCode>
     */
    #[ORM\OneToMany(targetEntity: EmailVerificationCode::class, mappedBy: 'user')]
    private Collection $code;

    #[ORM\OneToOne(targetEntity: ClientProfile::class, mappedBy: 'user')]
    /** @phpstan-ignore property.unusedType */
    private ?ClientProfile $clientProfile = null;

    #[ORM\OneToOne(targetEntity: TherapistProfile::class, mappedBy: 'user')]
    /** @phpstan-ignore property.unusedType */
    private ?TherapistProfile $therapistProfile = null;

    #[ORM\OneToOne(targetEntity: UserSettings::class, mappedBy: 'user')]
    /** @phpstan-ignore property.unusedType */
    private ?UserSettings $settings = null;

    public function __construct()
    {
        $this->code      = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }
    public function getUserIdentifier(): string { return $this->email; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return array_unique(array_merge(['ROLE_USER'], $this->roles));
    }

    /**
     * @param string[] $roles
     */
    public function setRoles(array $roles): self { $this->roles = $roles; return $this; }

    /**
     * @return string[]
     */
    public function getRawRoles(): array { return $this->roles; }

    public function getPrimaryRole(): string
    {
        foreach ($this->roles as $role) {
            if ($role !== 'ROLE_USER') return $role;
        }
        return 'ROLE_USER';
    }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }

    public function eraseCredentials(): void {}

    public function isVerified(): bool { return $this->isVerified; }
    public function setIsVerified(bool $verified): self { $this->isVerified = $verified; return $this; }

    public function getFirstName(): ?string { return $this->firstName; }
    public function setFirstName(?string $firstName): self { $this->firstName = $firstName; return $this; }

    public function getLastName(): ?string { return $this->lastName; }
    public function setLastName(?string $lastName): self { $this->lastName = $lastName; return $this; }

    public function getFullName(): string
    {
        return trim(($this->firstName ?? '') . ' ' . ($this->lastName ?? ''));
    }

    public function getProfilePicture(): ?string { return $this->profilePicture; }
    public function setProfilePicture(?string $profilePicture): self { $this->profilePicture = $profilePicture; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(?\DateTimeInterface $createdAt): self { $this->createdAt = $createdAt; return $this; }

    public function getLastLogin(): ?\DateTimeInterface { return $this->lastLogin; }
    public function setLastLogin(?\DateTimeInterface $lastLogin): self { $this->lastLogin = $lastLogin; return $this; }

    public function getPhoneNumber(): ?string { return $this->phoneNumber; }
    public function setPhoneNumber(?string $phoneNumber): self { $this->phoneNumber = $phoneNumber; return $this; }

    /**
     * @return Collection<int, EmailVerificationCode>
     */
    public function getCode(): Collection { return $this->code; }

    public function getClientProfile(): ?ClientProfile { return $this->clientProfile; }
    public function getTherapistProfile(): ?TherapistProfile { return $this->therapistProfile; }
    public function getSettings(): ?UserSettings { return $this->settings; }

    public function getProfilePictureUrl(): ?string
    {
        if (!$this->profilePicture) return null;

        if (str_starts_with($this->profilePicture, 'http')) {
            return $this->profilePicture;
        }

        if (str_starts_with($this->profilePicture, '/uploads/')) {
            return $this->profilePicture;
        }

        $filename = basename($this->profilePicture);
        return '/uploads/profiles/' . $filename;
    }
}