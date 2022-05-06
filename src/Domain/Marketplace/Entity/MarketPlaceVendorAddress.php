<?php

namespace App\Domain\Marketplace\Entity;

use App\Domain\Marketplace\Repository\MarketPlaceVendorAddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MarketPlaceVendorAddressRepository::class)]
class MarketPlaceVendorAddress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $city;

    #[ORM\OneToOne(inversedBy: 'marketPlaceVendorAddress', targetEntity: MarketplaceVendor::class, cascade: ['persist', 'remove'])]
    private ?MarketplaceVendor $marketplaceVendor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getMarketplaceVendor(): ?MarketplaceVendor
    {
        return $this->marketplaceVendor;
    }

    public function setMarketplaceVendor(?MarketplaceVendor $marketplaceVendor): self
    {
        $this->marketplaceVendor = $marketplaceVendor;

        return $this;
    }
}
