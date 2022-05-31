<?php

declare(strict_types=1);

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

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $firstName;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $lastName;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $phoneNumber;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $company;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $countryCode;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $provinceCode;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $provinceName;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $street;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $postcode;

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     * @return MarketPlaceVendorAddress
     */
    public function setFirstName(?string $firstName): MarketPlaceVendorAddress
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return MarketPlaceVendorAddress
     */
    public function setLastName(?string $lastName): MarketPlaceVendorAddress
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return MarketPlaceVendorAddress
     */
    public function setPhoneNumber(?string $phoneNumber): MarketPlaceVendorAddress
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string|null $company
     * @return MarketPlaceVendorAddress
     */
    public function setCompany(?string $company): MarketPlaceVendorAddress
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     * @return MarketPlaceVendorAddress
     */
    public function setCountryCode(?string $countryCode): MarketPlaceVendorAddress
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvinceCode(): ?string
    {
        return $this->provinceCode;
    }

    /**
     * @param string|null $provinceCode
     * @return MarketPlaceVendorAddress
     */
    public function setProvinceCode(?string $provinceCode): MarketPlaceVendorAddress
    {
        $this->provinceCode = $provinceCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvinceName(): ?string
    {
        return $this->provinceName;
    }

    /**
     * @param string|null $provinceName
     * @return MarketPlaceVendorAddress
     */
    public function setProvinceName(?string $provinceName): MarketPlaceVendorAddress
    {
        $this->provinceName = $provinceName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * @return MarketPlaceVendorAddress
     */
    public function setStreet(?string $street): MarketPlaceVendorAddress
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @param string|null $postcode
     * @return MarketPlaceVendorAddress
     */
    public function setPostcode(?string $postcode): MarketPlaceVendorAddress
    {
        $this->postcode = $postcode;
        return $this;
    }

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
