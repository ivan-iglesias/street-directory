<?php

namespace App\Repository;

use App\Entity\Street;
use App\Paginator\PagerfantaPaginator;
use App\Paginator\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Street|null find($id, $lockMode = null, $lockVersion = null)
 * @method Street|null findOneBy(array $criteria, array $orderBy = null)
 * @method Street[]    findAll()
 * @method Street[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StreetRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PagerfantaPaginator $paginator
    ) {
        parent::__construct($registry, Street::class);
    }

    public function findByCityCode(
        string $cityCode,
        ?int $page,
        ?int $pageSize
    ): Paginator {
        $queryBuilder = $this
            ->createQueryBuilder('s')
            ->join('s.city', 'c')
            ->where('c.code = :cityCode')
            ->setParameter('cityCode', $cityCode)
            ->orderBy('s.id', 'ASC')
        ;

        $this->paginator->paginate(
            $queryBuilder,
            $page,
            $pageSize
        );

        return $this->paginator;
    }

    // /**
    //  * @return Street[] Returns an array of Street objects
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
    public function findOneBySomeField($value): ?Street
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
