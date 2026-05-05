<?php

namespace App\Repository;

use App\Entity\Inscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<Inscription> */
class InscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscription::class);
    }

    public function findOldestWaitingList(\App\Entity\Event $event): ?Inscription
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.evenement = :event')
            ->andWhere('i.statut = :status')
            ->setParameter('event', $event)
            ->setParameter('status', Inscription::STATUS_WAITING)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /** @return array<int, array<string, mixed>> */
    public function countByStatus(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        return $conn->executeQuery("
            SELECT statut AS status, COUNT(*) AS count
            FROM inscription
            GROUP BY statut
        ")->fetchAllAssociative();
    }

    /** @return array<int, array<string, mixed>> */
    public function countByMonth(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        return $conn->executeQuery("
            SELECT DATE_FORMAT(date_inscription, '%b %Y') AS month, COUNT(*) AS count
            FROM inscription
            WHERE date_inscription >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY YEAR(date_inscription), MONTH(date_inscription)
            ORDER BY YEAR(date_inscription), MONTH(date_inscription)
        ")->fetchAllAssociative();
    }

    /** @return array<int, array<string, mixed>> */
    public function getTopEvents(int $limit = 5): array
    {
        $conn = $this->getEntityManager()->getConnection();
        return $conn->executeQuery("
            SELECT e.titre, COUNT(i.id_inscription) AS total
            FROM inscription i
            JOIN event e ON i.id_evenement = e.id_event
            GROUP BY e.id_event, e.titre
            ORDER BY total DESC
            LIMIT " . (int)$limit . "
        ")->fetchAllAssociative();
    }

    /** @return array<int, array<string, mixed>> */
    public function getOccupancyRates(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $results = $conn->executeQuery("
            SELECT e.titre, e.capacite,
                   SUM(CASE WHEN i.statut = 'CONFIRMÉ' THEN 1 ELSE 0 END) AS confirmed
            FROM event e
            LEFT JOIN inscription i ON i.id_evenement = e.id_event
            GROUP BY e.id_event, e.titre, e.capacite
            ORDER BY e.date_event DESC
        ")->fetchAllAssociative();

        return array_map(fn($r) => [
            'titre'     => $r['titre'],
            'confirmed' => (int)$r['confirmed'],
            'capacite'  => (int)$r['capacite'],
            'rate'      => $r['capacite'] > 0
                ? round(((int)$r['confirmed'] / (int)$r['capacite']) * 100, 1)
                : 0,
        ], $results);
    }

    /** @return array<int, Inscription> */
    public function filterInscriptions(?string $q, ?int $eventId, ?string $status, ?string $sortBy): array
    {
        $qb = $this->createQueryBuilder('i')
            ->leftJoin('i.evenement', 'e')
            ->addSelect('e');

        if (!empty($q)) {
            $qb->andWhere('i.nomParticipant LIKE :q OR i.emailParticipant LIKE :q')
               ->setParameter('q', '%' . $q . '%');
        }

        if (!empty($eventId)) {
            $qb->andWhere('e.id = :eventId')
               ->setParameter('eventId', $eventId);
        }

        if (!empty($status)) {
            $qb->andWhere('i.statut = :status')
               ->setParameter('status', $status);
        }

        if ($sortBy === 'name_asc') {
            $qb->orderBy('i.nomParticipant', 'ASC');
        } elseif ($sortBy === 'name_desc') {
            $qb->orderBy('i.nomParticipant', 'DESC');
        } elseif ($sortBy === 'date_desc') {
            $qb->orderBy('i.dateInscription', 'DESC');
        } else {
            $qb->orderBy('i.dateInscription', 'ASC');
        }

        return $qb->getQuery()->getResult();
    }
}
