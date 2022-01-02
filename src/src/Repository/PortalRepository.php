<?php

namespace App\Repository;

use App\Entity\Portal;
use App\Paginator\PagerfantaPaginator;
use App\Paginator\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Portal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Portal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Portal[]    findAll()
 * @method Portal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortalRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PagerfantaPaginator $paginator
    ) {
        parent::__construct($registry, Portal::class);
    }

    public function findByStreetUuid(
        string $streetUuid,
        ?int $page,
        ?int $pageSize
    ): Paginator {
        $queryBuilder = $this
            ->createQueryBuilder('p')
            ->join('p.street', 's')
            ->where('s.uuid = :streetUuid')
            ->setParameter('streetUuid', $streetUuid, 'uuid')
            ->orderBy('p.id', 'ASC')
        ;

        $this->paginator->paginate(
            $queryBuilder,
            $page,
            $pageSize
        );

        return $this->paginator;
    }

    // /**
    //  * @return Portal[] Returns an array of Portal objects
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
    public function findOneBySomeField($value): ?Portal
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
