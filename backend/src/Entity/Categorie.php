<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ORM\Table(name: 'categorie')]
#[UniqueEntity(fields: ['nom'], message: 'A category with this name already exists.')]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_categorie', type: 'integer')]
    /** @phpstan-ignore property.unusedType */
    private ?int $id = null;

    #[ORM\Column(name: 'nom', type: 'string', length: 100, unique: true)]
    #[Assert\NotBlank(message: 'The name cannot be empty.')]
    #[Assert\Length(min: 2, max: 100, minMessage: 'The name must contain at least {{ limit }} characters.', maxMessage: 'The name cannot exceed {{ limit }} characters.')]
    #[Assert\Regex(pattern: '/^[a-zA-ZÀ-ÿ0-9\s\'\-]+$/u', message: 'The name can only contain letters, numbers, spaces, apostrophes and hyphens.')]
    private ?string $nom = null;

    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    #[Assert\Length(max: 1000, maxMessage: 'The description cannot exceed {{ limit }} characters.')]
    private ?string $description = null;

    /** @var Collection<int, Article> */
    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Article::class)]
    private Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }

    /** @return Collection<int, Article> */
    public function getArticles(): Collection { return $this->articles; }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setCategorie($this);
        }
        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article) && $article->getCategorie() === $this) {
            $article->setCategorie(null);
        }
        return $this;
    }

    public function __toString(): string { return $this->nom ?? ''; }
}