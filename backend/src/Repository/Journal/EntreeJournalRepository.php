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

    public function searchAdvanced(int $userId, ?string $keyword, ?string $date, ?int $humeur): array
{
    $qb = $this->createQueryBuilder('e')
        ->where('e.user = :uid')
        ->setParameter('uid', $userId);

    // 🔤 Recherche texte
    if (!empty($keyword)) {
        $qb->andWhere('e.noteTextuelle LIKE :kw')
           ->setParameter('kw', '%' . $keyword . '%');
    }

    // 📅 Recherche par date
    if (!empty($date)) {
        $qb->andWhere('DATE(e.dateSaisie) = :date')
           ->setParameter('date', $date);
    }

    // 😊 Recherche par humeur
    if (!empty($humeur)) {
        $qb->andWhere('e.humeur = :humeur')
           ->setParameter('humeur', $humeur);
    }

    return $qb->orderBy('e.dateSaisie', 'DESC')
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