<?php

namespace App\Repository;

use App\Entity\Soustheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Soustheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soustheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soustheme[]    findAll()
 * @method Soustheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousthemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soustheme::class);
    }

    // /**
    //  * @return Soustheme[] Returns an array of Soustheme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Soustheme
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
