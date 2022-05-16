<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\Dto;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\MarketPlace\Entity\MarketPlaceVendorAddress;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'create_vendor' => [
            'method' => 'POST',
            'path' => '/shop/create-vendor',
            'denormalization_context' => ['groups' => 'shop:create:vendor'],
        ],
    ],
    itemOperations: []
)]
class MarketPlaceVendorCreate
{
    #[ApiProperty(identifier: true)]
    private ?int $marketPlaceVendorId;

    #[Groups(['shop:create:vendor'])]
    private MarketPlaceVendorAddress $marketPlaceVendorAddress;

    public function getMarketPlaceVendorAddress(): MarketPlaceVendorAddress
    {
        return $this->marketPlaceVendorAddress;
    }

    public function setMarketPlaceVendorAddress(MarketPlaceVendorAddress $marketPlaceVendorAddress): void
    {
        $this->marketPlaceVendorAddress = $marketPlaceVendorAddress;
    }

    public function getMarketPlaceVendorId(): ?int
    {
        return $this->marketPlaceVendorId;
    }

    public function setMarketPlaceVendorId(?int $marketPlaceVendorId): void
    {
        $this->marketPlaceVendorId = $marketPlaceVendorId;
    }
}
