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
}
