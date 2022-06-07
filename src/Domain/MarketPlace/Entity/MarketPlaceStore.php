<?php

namespace App\Domain\MarketPlace\Entity;

use App\Domain\MarketPlace\Repository\MarketPlaceStoreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MarketPlaceStoreRepository::class)]
class MarketPlaceStore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: MarketPlaceVendor::class, inversedBy: 'marketPlaceStores')]
    private ?MarketPlaceVendor $marketPlaceVendor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $lastName;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $storeName;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $phoneNumber;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 4, nullable: true)]
    private ?string $countryCode;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $street;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $city;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $postalCode;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $streetNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarketPlaceVendor(): ?MarketPlaceVendor
    {
        return $this->marketPlaceVendor;
    }

    public function setMarketPlaceVendor(?MarketPlaceVendor $marketPlaceVendor): self
    {
        $this->marketPlaceVendor = $marketPlaceVendor;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
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

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getStreetNumber(): ?int
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(?int $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }


    public function getStoreName(): ?string
    {
        return $this->storeName;
    }


    public function setStoreName(?string $storeName): self
    {
        $this->storeName = $storeName;

        return $this;
    }
}
