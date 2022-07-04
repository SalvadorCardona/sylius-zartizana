<?php

namespace App\Domain\MarketPlace\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Domain\MarketPlace\Entity\MarketPlaceProduct;
use App\Domain\MarketPlace\Factory\MarketPlaceProductFactory;

final class MarketPlaceProductCreatePersister implements DataPersisterInterface
{
    public function __construct(
        private MarketPlaceProductFactory $marketPlaceProductFactory
    ) {}

    /**
     * @param array<array-key, string> $context
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof MarketPlaceProduct
            && $context['collection_operation_name'] === 'create_marketplace_product';
    }

    public function persist($data)
    {
        // TODO: Implement persist() method.
    }

    public function remove($data)
    {
        // TODO: Implement remove() method.
    }
}
