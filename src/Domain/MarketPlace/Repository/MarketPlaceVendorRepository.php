<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\Repository;

use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository as EntityRepositoryAlias;

/**
 * @method MarketPlaceVendor|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketPlaceVendor|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketPlaceVendor[]    findAll()
 * @method MarketPlaceVendor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketPlaceVendorRepository extends EntityRepositoryAlias
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(MarketPlaceVendor::class));
    }
}
