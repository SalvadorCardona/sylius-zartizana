<?php
declare(strict_types=1);


namespace App\Domain\MarketPlace\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Domain\MarketPlace\Dto\MarketPlaceVendorCreate;
use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use App\Domain\MarketPlace\Entity\MarketPlaceVendorAddress;
use App\Domain\MarketPlace\Service\MarketPlaceVendorService;
use App\Entity\User\ShopUser;
use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Sylius\Bundle\ApiBundle\Context\TokenBasedUserContext;

class MarketPlaceVendorCreatePersister implements DataPersisterInterface
{
    public function __construct(private TokenBasedUserContext $userContext, private MarketPlaceVendorService $martketplaceVendorService)
    {
    }

    public function supports($data): bool
    {
        return $data instanceof MarketPlaceVendorCreate;
    }

    /**
     * @param MarketPlaceVendorCreate $data
     * @return MarketPlaceVendor
     */
    public function persist($data)
    {
        /** @var ShopUser|null $user */
        $user = $this->userContext->getUser();

        if (!$user) {
            throw new BadRequestException((string) $user);
        }

        try {
            $marketPlaceVendor = $this->martketplaceVendorService->createVendor($user->getId(), $data->getMarketPlaceVendorAddress());
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }

        return $marketPlaceVendor;
    }


    public function remove($data)
    {
        // TODO: Implement remove() method.
    }
}
