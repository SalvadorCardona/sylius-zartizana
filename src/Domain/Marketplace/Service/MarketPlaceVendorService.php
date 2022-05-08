<?php
declare(strict_types=1);


namespace App\Domain\Marketplace\Service;


use App\Domain\Marketplace\Entity\MarketplaceVendor;
use App\Domain\Marketplace\Entity\MarketPlaceVendorAddress;
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
    public function createVendor(int $shopUserId, MarketPlaceVendorAddress $marketPlaceVendorAddress): void {
        $repository = $this->entityManager->getRepository(ShopUser::class);
        /** @var ShopUser|null $shopUser */
        $shopUser = $repository->findOneBy(['id' => $shopUserId]);

        if (!$shopUser) {
            throw new Exception('User not Found for create vendor');
        }

        if ($shopUser->getMarketplaceVendor()) {
            throw new Exception('User is Vendor');
        }

        $marketPlaceVendor = new MarketPlaceVendor();
        $marketPlaceVendor->setUser($shopUser);
        $marketPlaceVendor->setMarketPlaceVendorAddress($marketPlaceVendorAddress);

        $this->entityManager->persist($marketPlaceVendor);
    }
}
