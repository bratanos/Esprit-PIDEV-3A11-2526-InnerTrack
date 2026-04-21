<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * Count events grouped by TypeEvent (for Pie Chart).
     * Returns: [['type' => 'Conférence', 'count' => 5], ...]
     */
    public function countByType(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $results = $conn->executeQuery("
            SELECT id_type_event AS type_id, COUNT(*) AS count
            FROM event
            GROUP BY id_type_event
            ORDER BY id_type_event
        ")->fetchAllAssociative();

        $labels = [1 => 'Conférence', 2 => 'Atelier', 3 => 'Forum', 4 => 'Webinaire'];
        return array_map(fn($r) => [
            'type'  => $labels[(int)$r['type_id']] ?? 'Inconnu',
            'count' => (int)$r['count'],
        ], $results);
    }

    /**
     * Count events created per month (last 6 months) for Bar Chart.
     * Returns: [['month' => 'Jan 2026', 'count' => 3], ...]
     */
    public function countByMonth(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        return $conn->executeQuery("
            SELECT DATE_FORMAT(date_creation, '%b %Y') AS month, COUNT(*) AS count
            FROM event
            WHERE date_creation >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY YEAR(date_creation), MONTH(date_creation)
            ORDER BY YEAR(date_creation), MONTH(date_creation)
        ")->fetchAllAssociative();
    }

    /**
     * Count active vs inactive events (for Doughnut Chart).
     * Returns: ['active' => 10, 'inactive' => 3]
     */
    public function countActiveVsInactive(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $result = $conn->executeQuery("
            SELECT
                SUM(CASE WHEN statut = 1 THEN 1 ELSE 0 END) AS active,
                SUM(CASE WHEN statut = 0 THEN 1 ELSE 0 END) AS inactive
            FROM event
        ")->fetchAssociative();

        return [
            'active'   => (int)($result['active'] ?? 0),
            'inactive' => (int)($result['inactive'] ?? 0),
        ];
    }
}
