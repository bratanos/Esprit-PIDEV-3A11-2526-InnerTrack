<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: 'article')]
#[UniqueEntity(fields: ['titre'], message: 'An article with this title already exists.')]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_Article', type: 'integer')]
    /** @phpstan-ignore property.unusedType */
    private ?int $id = null;

    #[ORM\Column(name: 'titre', type: 'string', length: 255, unique: true)]
    #[Assert\NotBlank(message: 'Title cannot be empty.')]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Title must be at least {{ limit }} characters.',
        maxMessage: 'Title cannot exceed {{ limit }} characters.',
    )]
    private ?string $titre = null;

    #[ORM\Column(name: 'contenu', type: 'text')]
    #[Assert\NotBlank(message: 'Content cannot be empty.')]
    #[Assert\Length(
        min: 20,
        minMessage: 'Content must be at least {{ limit }} characters.'
    )]
    private ?string $contenu = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'auteur_user_id', nullable: false)]
    private ?User $auteur = null;

    #[ORM\Column(name: 'datePublication', type: 'date')]
    #[Assert\NotNull(message: 'Publication date is required.')]
    #[Assert\LessThanOrEqual(
        value: 'today',
        message: 'Publication date cannot be in the future.'
    )]
    private ?\DateTimeInterface $datePublication = null;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(name: 'id_categorie', referencedColumnName: 'id_categorie', nullable: true)]
    #[Assert\NotNull(message: 'Please select a category.')]
    private ?Categorie $categorie = null;

    #[ORM\Column(name: 'readability', type: 'string', length: 50, nullable: true)]
    private ?string $readability = null;

    /** @var Collection<int, Tag> */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'articles')]
    #[ORM\JoinTable(
        name: 'article_tag',
        joinColumns: [new ORM\JoinColumn(name: 'id_article', referencedColumnName: 'id_Article')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'id_tag', referencedColumnName: 'id_tag')]
    )]
    private Collection $tags;

    public function __construct()
    {
        $this->datePublication = new \DateTime();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getTitre(): ?string { return $this->titre; }
    public function setTitre(string $titre): static { $this->titre = $titre; return $this; }

    public function getContenu(): ?string { return $this->contenu; }
    public function setContenu(string $contenu): static { $this->contenu = $contenu; return $this; }

    public function getAuteur(): ?User { return $this->auteur; }
    public function setAuteur(?User $auteur): static { $this->auteur = $auteur; return $this; }

    public function getDatePublication(): ?\DateTimeInterface { return $this->datePublication; }
    public function setDatePublication(?\DateTimeInterface $date): static { $this->datePublication = $date; return $this; }

    public function getCategorie(): ?Categorie { return $this->categorie; }
    public function setCategorie(?Categorie $categorie): static { $this->categorie = $categorie; return $this; }

    public function getReadability(): ?string { return $this->readability; }
    public function setReadability(?string $readability): static { $this->readability = $readability; return $this; }

    /** @return Collection<int, Tag> */
    public function getTags(): Collection { return $this->tags; }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);
        return $this;
    }
}