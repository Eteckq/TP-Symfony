<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Article[] Returns an array of Article objects from a text
     */
    public function findFromQuery($query)
    {
        // Je n'ai pas utlisé "orWhere" pour faire le "ou", à cause de cet article:
        // https://symfonycasts.com/screencast/doctrine-queries/and-where-or-where#avoid-orwhere-and-where
        return $this->createQueryBuilder('a')
            ->andWhere('a.libelle LIKE :query OR a.texte LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->getQuery()
            ->getResult()
        ;
    }

}
