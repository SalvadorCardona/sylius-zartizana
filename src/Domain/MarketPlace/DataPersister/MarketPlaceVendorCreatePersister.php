<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use App\Domain\MarketPlace\Service\MarketPlaceVendorService;
use App\Entity\User\ShopUser;
use Exception;
use Sylius\Bundle\ApiBundle\Context\TokenBasedUserContext;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

final class MarketPlaceVendorCreatePersister implements DataPersisterInterface
{
    public function __construct(
        private TokenBasedUserContext $userContext,
        private MarketPlaceVendorService $marketPlaceVendorService
    ) {
    }

    /**
     * @param array<array-key, string> $context
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof MarketPlaceVendor && $context['collection_operation_name'] === 'create_vendor';
    }

    /**
     * @param MarketPlaceVendor $data
     */
    public function persist($data): MarketPlaceVendor
    {
        /** @var ShopUser|null $user */
        $user = $this->userContext->getUser();

        if (!$user) {
            throw new BadRequestException((string) $user);
        }

        try {
            $marketPlaceVendor = $this->marketPlaceVendorService->createVendor(
                $user,
                $data
            );
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }

        return $marketPlaceVendor;
    }

    public function remove($data): bool
    {
        return true;
    }
}
