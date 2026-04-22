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
    public function searchAdvanced(int $userId, ?string $keyword, ?string $emotion, ?int $energieMin, ?int $energieMax, ?int $stressMax, ?string $date, string $sort = 'dateCreation', string $order = 'DESC'): array
{
    $allowed = ['dateCreation', 'niveauEnergie', 'niveauStress', 'qualiteSommeil', 'nomHabitude'];
    if (!in_array($sort, $allowed)) $sort = 'dateCreation';
    if (!in_array($order, ['ASC', 'DESC'])) $order = 'DESC';

    $qb = $this->createQueryBuilder('h')
        ->where('h.user = :uid')
        ->setParameter('uid', $userId);

    if (!empty($keyword)) {
        $qb->andWhere('h.nomHabitude LIKE :kw OR h.noteTextuelle LIKE :kw')
           ->setParameter('kw', '%' . $keyword . '%');
    }

    if (!empty($emotion)) {
        $qb->andWhere('h.emotionDominantes = :emotion')
           ->setParameter('emotion', $emotion);
    }

    if ($energieMin !== null) {
        $qb->andWhere('h.niveauEnergie >= :energieMin')
           ->setParameter('energieMin', $energieMin);
    }

    if ($energieMax !== null) {
        $qb->andWhere('h.niveauEnergie <= :energieMax')
           ->setParameter('energieMax', $energieMax);
    }

    if ($stressMax !== null) {
        $qb->andWhere('h.niveauStress <= :stressMax')
           ->setParameter('stressMax', $stressMax);
    }

    if (!empty($date)) {
    $qb->andWhere('h.dateCreation = :date')
       ->setParameter('date', new \DateTime($date), \Doctrine\DBAL\Types\Types::DATE_MUTABLE);
}
    return $qb->orderBy('h.' . $sort, $order)
              ->getQuery()
              ->getResult();
}
}