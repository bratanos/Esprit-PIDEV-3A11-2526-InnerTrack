<?php

namespace App\Repository\Journal;

use App\Entity\Journal\EntreeJournal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EntreeJournalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntreeJournal::class);
    }

    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.user = :uid')
            ->setParameter('uid', $userId)
            ->orderBy('e.dateSaisie', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function search(string $keyword, int $userId): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.user = :uid')
            ->andWhere('e.noteTextuelle LIKE :kw')
            ->setParameter('uid', $userId)
            ->setParameter('kw', '%' . $keyword . '%')
            ->orderBy('e.dateSaisie', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getStatsByUserId(int $userId): array
    {
        return $this->createQueryBuilder('e')
            ->select(
                'COUNT(e.idJournal) AS total',
                'AVG(e.humeur)      AS avgHumeur'
            )
            ->where('e.user = :uid')
            ->setParameter('uid', $userId)
            ->getQuery()
            ->getSingleResult();
    }
}