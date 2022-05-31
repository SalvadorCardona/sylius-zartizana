<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\Repository;

use App\Domain\MarketPlace\Entity\MarketPlaceBankAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MarketPlaceBankAccount>
 *
 * @method MarketPlaceBankAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketPlaceBankAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketPlaceBankAccount[]    findAll()
 * @method MarketPlaceBankAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketPlaceBankAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketPlaceBankAccount::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MarketPlaceBankAccount $entity, bool $flush = true): void
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
    public function remove(MarketPlaceBankAccount $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MarketPlaceBankAccount[] Returns an array of MarketPlaceBankAccount objects
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
    public function findOneBySomeField($value): ?MarketPlaceBankAccount
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
