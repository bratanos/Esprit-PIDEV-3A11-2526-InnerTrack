<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<Event> */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /** @return array<int, Event> */
    public function filterEvents(?string $q, ?int $type, ?string $period, ?string $avail): array
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.statut = :statut')
            ->setParameter('statut', true)
            ->orderBy('e.date', 'ASC');

        if (!empty($q)) {
            $qb->andWhere('e.titre LIKE :q OR e.description LIKE :q')
               ->setParameter('q', '%' . $q . '%');
        }

        if (!empty($type)) {
            $qb->andWhere('e.type = :type')
               ->setParameter('type', $type);
        }

        if ($period === 'upcoming') {
            $qb->andWhere('e.date >= :today')
               ->setParameter('today', new \DateTime('today'));
        } elseif ($period === 'past') {
            $qb->andWhere('e.date < :today')
               ->setParameter('today', new \DateTime('today'));
        }

        if ($avail === 'available') {
            $qb->andWhere(
                'e.capacite > (
                    SELECT COUNT(i.id) FROM App\Entity\Inscription i
                    WHERE i.evenement = e AND i.statut = :conf_status
                )'
            )->setParameter('conf_status', \App\Entity\Inscription::STATUS_CONFIRMED);
        } elseif ($avail === 'full') {
            $qb->andWhere(
                'e.capacite <= (
                    SELECT COUNT(i.id) FROM App\Entity\Inscription i
                    WHERE i.evenement = e AND i.statut = :conf_status
                )'
            )->setParameter('conf_status', \App\Entity\Inscription::STATUS_CONFIRMED);
        }

        return $qb->getQuery()->getResult();
    }

    /** @return array<int, array<string, mixed>> */
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

    /** @return array<int, array<string, mixed>> */
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

    /** @return array<string, int> */
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
