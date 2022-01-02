<?php

namespace App\Repository;

use App\Entity\City;
use App\Paginator\PagerfantaPaginator;
use App\Paginator\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PagerfantaPaginator $paginator
    ) {
        parent::__construct($registry, City::class);
    }

    public function findByProvinceCode(
        string $provinceCode,
        ?int $page,
        ?int $pageSize
    ): Paginator {
        $queryBuilder = $this
            ->createQueryBuilder('c')
            ->join('c.province', 'p')
            ->where('p.code = :provinceCode')
            ->setParameter('provinceCode', $provinceCode)
            ->orderBy('c.id', 'ASC')
        ;

        $this->paginator->paginate(
            $queryBuilder,
            $page,
            $pageSize
        );

        return $this->paginator;
    }

    // /**
    //  * @return City[] Returns an array of City objects
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
    public function findOneBySomeField($value): ?City
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
