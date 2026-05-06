<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /** @return Article[] */
    public function findAllWithCategory(): array
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.categorie', 'c')
            ->addSelect('c')
            ->orderBy('a.datePublication', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /** @return Article[] */
    public function findByTagName(string $tagName): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.tags', 't')
            ->leftJoin('a.categorie', 'c')
            ->addSelect('c')
            ->where('LOWER(t.nom) = LOWER(:nom)')
            ->setParameter('nom', $tagName)
            ->orderBy('a.datePublication', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /** @return Article[] */
    public function search(string $q): array
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.categorie', 'c')
            ->addSelect('c')
            ->where('LOWER(a.titre) LIKE LOWER(:q)')
            ->orWhere('LOWER(a.contenu) LIKE LOWER(:q)')
            ->orWhere('LOWER(c.nom) LIKE LOWER(:q)')
            ->setParameter('q', '%' . $q . '%')
            ->orderBy('a.datePublication', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /** @return Article[] */
    public function findByCategorieId(int $id): array
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.categorie', 'c')
            ->addSelect('c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->orderBy('a.datePublication', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function createQueryBuilderForIndex(string $q = '', ?string $catId = null, ?string $tag = null): \Doctrine\ORM\QueryBuilder
    {
        $qb = $this->createQueryBuilder('a')
            ->leftJoin('a.categorie', 'c')
            ->leftJoin('a.tags', 't')
            ->addSelect('c', 't')
            ->orderBy('a.datePublication', 'DESC');

        if ($q !== '') {
            $qb->andWhere('LOWER(a.titre) LIKE LOWER(:q) OR LOWER(a.contenu) LIKE LOWER(:q)')
               ->setParameter('q', '%' . $q . '%');
        }
        if ($catId) {
            $qb->andWhere('c.id = :catId')->setParameter('catId', (int) $catId);
        }
        if ($tag) {
            $qb->andWhere('t.nom = :tag')->setParameter('tag', $tag);
        }

        return $qb;
    }
}