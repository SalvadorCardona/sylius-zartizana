<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\Service;

use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use App\Entity\User\ShopUser;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class MarketPlaceVendorService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws Exception
     */
    public function createVendor(ShopUser $shopUser, MarketPlaceVendor $marketPlaceVendor): MarketPlaceVendor
    {
        if ($shopUser->getMarketPlaceVendor()) {
            throw new Exception('User is Vendor');
        }

        $marketPlaceVendor->setUser($shopUser);

        $this->entityManager->persist($marketPlaceVendor);
        $this->entityManager->flush();

        return $marketPlaceVendor;
    }
}
