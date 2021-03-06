<?php

namespace App\Repository;

use App\Entity\Mantor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mantor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mantor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mantor[]    findAll()
 * @method Mantor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MantorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mantor::class);
    }

    // /**
    //  * @return Mantor[] Returns an array of Mantor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mantor
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
