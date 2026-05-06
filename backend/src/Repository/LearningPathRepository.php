<?php

namespace App\Repository;

use App\Entity\LearningPath;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/** @extends ServiceEntityRepository<LearningPath> */
class LearningPathRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LearningPath::class);
    }

    /** @return LearningPath[] */
    public function findAllWithCreator(): array
    {
        return $this->createQueryBuilder('lp')
            ->leftJoin('lp.createdBy', 'u')
            ->addSelect('u')
            ->orderBy('lp.dateCreation', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find paths that contain a given article.
     *
     * @return LearningPath[]
     */
    public function findByArticle(int $articleId): array
    {
        return $this->createQueryBuilder('lp')
            ->join('lp.pathArticles', 'pa')
            ->join('pa.article', 'a')
            ->where('a.id = :articleId')
            ->setParameter('articleId', $articleId)
            ->getQuery()
            ->getResult();
    }

    public function save(LearningPath $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) $this->getEntityManager()->flush();
    }

    public function remove(LearningPath $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);
        if ($flush) $this->getEntityManager()->flush();
    }
}
