<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    /**
     * All tags with their article count, ordered by count DESC.
     */
    public function findAllWithCount(): array
    {
        return $this->createQueryBuilder('t')
            ->select('t', 'COUNT(a.id) AS articleCount')
            ->leftJoin('t.articles', 'a')
            ->groupBy('t.id')
            ->orderBy('articleCount', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByNom(string $nom): ?Tag
    {
        return $this->findOneBy(['nom' => $nom]);
    }

    /**
     * Articles that share at least one tag with the given article, excluding itself.
     * Returns up to $limit results.
     *
     * @return \App\Entity\Article[]
     */
    public function findRelatedArticles(\App\Entity\Article $article, int $limit = 3): array
    {
        $tagIds = $article->getTags()->map(fn($t) => $t->getId())->toArray();

        if (empty($tagIds)) {
            return [];
        }

        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('a', 'COUNT(t.id) AS HIDDEN sharedCount')
            ->from(\App\Entity\Article::class, 'a')
            ->join('a.tags', 't')
            ->where('t.id IN (:tagIds)')
            ->andWhere('a.id != :currentId')
            ->setParameter('tagIds', $tagIds)
            ->setParameter('currentId', $article->getId())
            ->groupBy('a.id')
            ->orderBy('sharedCount', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
