<?php

namespace App\Repository;

use App\Entity\Inscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
            ->orderBy('i.id', 'ASC') // Since ID is sequential and we don't have exactly time in dateInscription, or we can order by dateInscription. Let's use id.
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Count inscriptions grouped by status (for Doughnut Chart).
     * Returns: [['status' => 'CONFIRMÉ', 'count' => 15], ...]
     */
    public function countByStatus(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        return $conn->executeQuery("
            SELECT statut AS status, COUNT(*) AS count
            FROM inscription
            GROUP BY statut
        ")->fetchAllAssociative();
    }

    /**
     * Count inscriptions per month (last 6 months) for Line Chart.
     * Returns: [['month' => 'Jan 2026', 'count' => 8], ...]
     */
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

    /**
     * Get top N events by number of inscriptions (for Horizontal Bar Chart).
     * Returns: [['titre' => 'Event Name', 'total' => 12], ...]
     */
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

    /**
     * Get occupancy rates per event (confirmed / capacity).
     * Returns: [['titre' => 'Event', 'confirmed' => 8, 'capacite' => 10, 'rate' => 80.0], ...]
     */
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
}
