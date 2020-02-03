<?php

namespace App\Repository;

use App\Entity\ApiRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ApiRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiRole[]    findAll()
 * @method ApiRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApiRole::class);
    }

    // /**
    //  * @return ApiRole[] Returns an array of ApiRole objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ApiRole
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
