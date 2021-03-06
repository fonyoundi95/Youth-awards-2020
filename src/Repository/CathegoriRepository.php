<?php

namespace App\Repository;

use App\Entity\Cathegori;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cathegori|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cathegori|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cathegori[]    findAll()
 * @method Cathegori[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CathegoriRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cathegori::class);
    }

    // /**
    //  * @return Cathegori[] Returns an array of Cathegori objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cathegori
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
