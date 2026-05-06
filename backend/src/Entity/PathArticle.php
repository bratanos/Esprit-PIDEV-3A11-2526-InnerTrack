<?php

namespace App\Entity;

use App\Repository\PathArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PathArticleRepository::class)]
#[ORM\Table(name: 'path_article')]
class PathArticle
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: LearningPath::class, inversedBy: 'pathArticles')]
    #[ORM\JoinColumn(name: 'id_path', referencedColumnName: 'id_path', nullable: false, onDelete: 'CASCADE')]
    private ?LearningPath $learningPath = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Article::class)]
    #[ORM\JoinColumn(name: 'id_article', referencedColumnName: 'id_Article', nullable: false, onDelete: 'CASCADE')]
    private ?Article $article = null;

    #[ORM\Column(name: 'ordre', type: 'integer')]
    private int $articleOrder = 0;

    public function getLearningPath(): ?LearningPath { return $this->learningPath; }
    public function setLearningPath(?LearningPath $lp): static { $this->learningPath = $lp; return $this; }

    public function getArticle(): ?Article { return $this->article; }
    public function setArticle(?Article $a): static { $this->article = $a; return $this; }

    public function getArticleOrder(): int { return $this->articleOrder; }
    public function setArticleOrder(int $o): static { $this->articleOrder = $o; return $this; }
}
