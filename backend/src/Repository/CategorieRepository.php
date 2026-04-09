<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    public function findAllOrderedByNom(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAllWithArticleCount(): array
    {
        return $this->createQueryBuilder('c')
            ->select('c', 'COUNT(a.id) AS articleCount')
            ->leftJoin('c.articles', 'a')
            ->groupBy('c.id')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function searchByNom(string $q): array
    {
        return $this->createQueryBuilder('c')
            ->where('LOWER(c.nom) LIKE LOWER(:q)')
            ->setParameter('q', '%' . $q . '%')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}