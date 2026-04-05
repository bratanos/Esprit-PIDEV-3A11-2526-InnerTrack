<?php

namespace App\Repository\Journal;

use App\Entity\Journal\Habitude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class HabitudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Habitude::class);
    }

    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder('h')
            ->where('h.user = :uid')
            ->setParameter('uid', $userId)
            ->orderBy('h.dateCreation', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function search(string $keyword, int $userId): array
    {
        return $this->createQueryBuilder('h')
            ->where('h.user = :uid')
            ->andWhere('h.nomHabitude LIKE :kw OR h.emotionDominantes LIKE :kw')
            ->setParameter('uid', $userId)
            ->setParameter('kw', '%' . $keyword . '%')
            ->orderBy('h.dateCreation', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getStatsByUserId(int $userId): array
    {
        return $this->createQueryBuilder('h')
            ->select(
                'COUNT(h.idHabit)      AS total',
                'AVG(h.niveauEnergie)  AS avgEnergie',
                'AVG(h.niveauStress)   AS avgStress',
                'AVG(h.qualiteSommeil) AS avgSommeil'
            )
            ->where('h.user = :uid')
            ->setParameter('uid', $userId)
            ->getQuery()
            ->getSingleResult();
    }
}