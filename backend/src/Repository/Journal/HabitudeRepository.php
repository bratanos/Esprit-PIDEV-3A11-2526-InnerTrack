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

    public function findByUserIdSorted(int $userId, string $sortBy = 'dateCreation', string $order = 'DESC'): array
    {
        $allowed = ['dateCreation', 'niveauEnergie', 'niveauStress', 'qualiteSommeil', 'nomHabitude'];
        if (!in_array($sortBy, $allowed)) $sortBy = 'dateCreation';
        if (!in_array($order, ['ASC', 'DESC'])) $order = 'DESC';
        
        return $this->createQueryBuilder('h')
        ->where('h.user = :uid')
        ->setParameter('uid', $userId)
        ->orderBy('h.' . $sortBy, $order)
        ->getQuery()
        ->getResult();
    }
}