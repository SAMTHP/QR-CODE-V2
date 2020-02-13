<?php

namespace App\Repository;

use App\Entity\Demo2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Demo2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demo2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demo2[]    findAll()
 * @method Demo2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Demo2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Demo2::class);
    }

    // /**
    //  * @return Demo2[] Returns an array of Demo2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Demo2
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
