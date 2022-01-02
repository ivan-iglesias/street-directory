<?php

namespace App\Repository;

use App\Entity\Province;
use App\Paginator\PagerfantaPaginator;
use App\Paginator\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Province|null find($id, $lockMode = null, $lockVersion = null)
 * @method Province|null findOneBy(array $criteria, array $orderBy = null)
 * @method Province[]    findAll()
 * @method Province[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProvinceRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PagerfantaPaginator $paginator
    ) {
        parent::__construct($registry, Province::class);
    }

    public function findAllPaginate(
        ?int $page,
        ?int $pageSize
    ): Paginator {
        $queryBuilder = $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC');

        $this->paginator->paginate(
            $queryBuilder,
            $page,
            $pageSize
        );

        return $this->paginator;
    }

    // /**
    //  * @return Province[] Returns an array of Province objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Province
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
