<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\Repository;

use App\Domain\MarketPlace\Entity\MarketPlaceVendorAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MarketPlaceVendorAddress>
 *
 * @method MarketPlaceVendorAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketPlaceVendorAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketPlaceVendorAddress[]    findAll()
 * @method MarketPlaceVendorAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketPlaceVendorAddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketPlaceVendorAddress::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MarketPlaceVendorAddress $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(MarketPlaceVendorAddress $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MarketPlaceVendorAddress[] Returns an array of MarketPlaceVendorAddress objects
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
    public function findOneBySomeField($value): ?MarketPlaceVendorAddress
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
