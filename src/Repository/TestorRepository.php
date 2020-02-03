<?php

namespace App\Repository;

use App\Entity\Testor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Testor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Testor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Testor[]    findAll()
 * @method Testor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Testor::class);
    }

    // /**
    //  * @return Testor[] Returns an array of Testor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Testor
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
