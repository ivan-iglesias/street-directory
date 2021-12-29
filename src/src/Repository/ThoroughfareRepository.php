<?php

namespace App\Repository;

use App\Entity\Thoroughfare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Thoroughfare|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thoroughfare|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thoroughfare[]    findAll()
 * @method Thoroughfare[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThoroughfareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thoroughfare::class);
    }

    // /**
    //  * @return Thoroughfare[] Returns an array of Thoroughfare objects
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
    public function findOneBySomeField($value): ?Thoroughfare
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
