<?php

namespace App\Repository;

use App\Entity\CommandLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandLine[]    findAll()
 * @method CommandLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandLine::class);
    }

    /**
     * @return CommandLine[] Returns an array of CommandLine objects
     */
    public function findTopSells($count)
    {
        $conn = $this->getEntityManager()->getConnection();
        //FIXME Use the query builder to prevent injection ? Should be ok since '$count' param is called from server, and client can't change this value (for now)
        $sql = 'SELECT id_article_id, sum(`command_line`.quantite) as quantite, article.visuel, article.id_category_id as category, article.libelle FROM `command_line`, `article` WHERE id_article_id = article.id group by command_line.`id_article_id` ORDER BY `quantite` DESC LIMIT ' . $count;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
   
}
