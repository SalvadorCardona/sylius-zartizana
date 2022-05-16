<?php

namespace App\Domain\MarketPlace\Entity;

use App\Domain\MarketPlace\Repository\MarketPlaceVendorAddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MarketPlaceVendorAddressRepository::class)]
class MarketPlaceVendorAddress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $city;

    #[ORM\OneToOne(
        mappedBy: 'marketPlaceVendorAddress',
        targetEntity: MarketPlaceVendor::class,
        cascade: ['persist', 'remove']
    )]
    private ?MarketPlaceVendor $marketPlaceVendor;

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

    public function getMarketPlaceVendor(): ?MarketPlaceVendor
    {
        return $this->marketPlaceVendor;
    }

    public function setMarketPlaceVendor(?MarketPlaceVendor $marketPlaceVendor): self
    {
        // unset the owning side of the relation if necessary
        if (null === $marketPlaceVendor && null !== $this->marketPlaceVendor) {
            $this->marketPlaceVendor->setMarketPlaceVendorAddress(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $marketPlaceVendor && $marketPlaceVendor->getMarketPlaceVendorAddress() !== $this) {
            $marketPlaceVendor->setMarketPlaceVendorAddress($this);
        }

        $this->marketPlaceVendor = $marketPlaceVendor;

        return $this;
    }
}
