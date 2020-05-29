<?php

namespace App\Repository;

use App\Entity\ReponseLongue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReponseLongue|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReponseLongue|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReponseLongue[]    findAll()
 * @method ReponseLongue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponseLongueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReponseLongue::class);
    }

    // /**
    //  * @return ReponseLongue[] Returns an array of ReponseLongue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReponseLongue
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
