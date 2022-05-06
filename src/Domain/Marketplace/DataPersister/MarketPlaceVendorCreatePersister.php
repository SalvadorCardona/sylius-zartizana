<?php
declare(strict_types=1);


namespace App\Domain\Marketplace\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Domain\Marketplace\Dto\MarketPlaceVendorCreate;
use App\Domain\Marketplace\Service\MarketPlaceVendorService;
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

//    public function __construct(private TokenStorageInterface $security, private MarketPlaceVendorService $martketplaceVendorService, private UserContextInterface $userContext)
//    {
//    }

//    public function __construct(private Security $security, private MarketPlaceVendorService $martketplaceVendorService)
//    {
//    }

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
        $user = $this->userContext->getUser();
        /** @var ShopUser|null $token */

        if (!$user) {
            throw new BadRequestException((string) $user);
        }

        try {
            $this->martketplaceVendorService->createVendor($user->getId(), $data->getMarketPlaceVendorAddress());
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }


    public function remove($data)
    {
        // TODO: Implement remove() method.
    }
}
