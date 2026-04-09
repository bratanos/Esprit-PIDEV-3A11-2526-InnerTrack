<?php

namespace App\Repository;

use App\Entity\PathArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PathArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PathArticle::class);
    }

    /**
     * Find the PathArticle entry for a given article inside a given path.
     */
    public function findEntry(int $pathId, int $articleId): ?PathArticle
    {
        return $this->createQueryBuilder('pa')
            ->join('pa.learningPath', 'lp')
            ->join('pa.article', 'a')
            ->where('lp.id = :pathId')
            ->andWhere('a.id = :articleId')
            ->setParameter('pathId', $pathId)
            ->setParameter('articleId', $articleId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Find the next PathArticle after a given order position in a path.
     */
    public function findNext(int $pathId, int $currentOrder): ?PathArticle
    {
        return $this->createQueryBuilder('pa')
            ->join('pa.learningPath', 'lp')
            ->where('lp.id = :pathId')
            ->andWhere('pa.articleOrder > :order')
            ->setParameter('pathId', $pathId)
            ->setParameter('order', $currentOrder)
            ->orderBy('pa.articleOrder', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Total steps in a path.
     */
    public function countSteps(int $pathId): int
    {
        return (int) $this->createQueryBuilder('pa')
            ->select('COUNT(pa.articleOrder)')
            ->join('pa.learningPath', 'lp')
            ->where('lp.id = :pathId')
            ->setParameter('pathId', $pathId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
