<?php

namespace App\Domain\MarketPlace\Repository;

use App\Domain\MarketPlace\Entity\MarketPlaceStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MarketPlaceStore>
 *
 * @method MarketPlaceStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketPlaceStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketPlaceStore[]    findAll()
 * @method MarketPlaceStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketPlaceStoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketPlaceStore::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MarketPlaceStore $entity, bool $flush = true): void
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
    public function remove(MarketPlaceStore $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MarketPlaceStore[] Returns an array of MarketPlaceStore objects
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
    public function findOneBySomeField($value): ?MarketPlaceStore
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
