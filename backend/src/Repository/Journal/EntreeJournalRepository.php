<?php

namespace App\Repository\Journal;

use App\Entity\Journal\EntreeJournal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EntreeJournal>
 */
class EntreeJournalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntreeJournal::class);
    }

    /**
     * @return EntreeJournal[]
     */
    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.user = :uid')
            ->setParameter('uid', $userId)
            ->orderBy('e.dateSaisie', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return EntreeJournal[]
     */
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

    /**
     * @return EntreeJournal[]
     */
    public function searchAdvanced(
        int     $userId,
        ?string $keyword,
        ?string $date,
        ?int    $humeur,
        string  $sort      = 'dateSaisie',
        string  $direction = 'DESC',
        ?int    $humeurMin = null,
        ?int    $humeurMax = null
    ): array {
        $allowedSorts   = ['dateSaisie', 'humeur'];
        $finalSort      = in_array($sort, $allowedSorts) ? 'e.' . $sort : 'e.dateSaisie';
        $finalDirection = strtoupper($direction) === 'ASC' ? 'ASC' : 'DESC';

        $qb = $this->createQueryBuilder('e')
            ->where('e.user = :uid')
            ->setParameter('uid', $userId);

        if (!empty($keyword)) {
            $qb->andWhere('e.noteTextuelle LIKE :kw')
               ->setParameter('kw', '%' . $keyword . '%');
        }

        if (!empty($date)) {
            $qb->andWhere('e.dateSaisie = :date')
               ->setParameter('date', new \DateTime($date));
        }

        if ($humeur !== null) {
            $qb->andWhere('e.humeur = :humeur')
               ->setParameter('humeur', $humeur);
        }

        if ($humeurMin !== null) {
            $qb->andWhere('e.humeur >= :humeurMin')
               ->setParameter('humeurMin', $humeurMin);
        }

        if ($humeurMax !== null) {
            $qb->andWhere('e.humeur <= :humeurMax')
               ->setParameter('humeurMax', $humeurMax);
        }

        return $qb->orderBy($finalSort, $finalDirection)
                  ->getQuery()
                  ->getResult();
    }

    /**
     * @return array<string, mixed>
     */
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