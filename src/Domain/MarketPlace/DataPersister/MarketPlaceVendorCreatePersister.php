<?php
declare(strict_types=1);


namespace App\Domain\MarketPlace\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Domain\MarketPlace\Dto\MarketPlaceVendorCreate;
use App\Domain\MarketPlace\Service\MarketPlaceVendorService;
use App\Entity\User\ShopUser;
use Exception;
use Sylius\Bundle\ApiBundle\Context\UserContextInterface;
use Sylius\Component\User\Model\UserInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @return void
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

        $data->setMarketPlaceVendorId($marketPlaceVendor->getId());

        return $data;
    }


    public function remove($data)
    {
        // TODO: Implement remove() method.
    }
}
