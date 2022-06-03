<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\MarketPlace\Repository\MarketPlaceVendorRepository;
use App\Entity\Product\Product;
use App\Entity\User\ShopUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Id\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: MarketPlaceVendorRepository::class)]
#[ApiResource]
class MarketPlaceVendor implements ResourceInterface
{
    public const CREATED = 'CREATED';
    public const WAITING_VALIDATION = 'WAITING_VALIDATION';
    public const VALIDATED = 'validated';

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id;

    #[ORM\OneToOne(inversedBy: 'marketplaceVendor', targetEntity: ShopUser::class, cascade: ['persist', 'remove'])]
    private ?ShopUser $user;

    /** @var Collection<int, Product> */
    #[ORM\OneToMany(mappedBy: 'marketplaceVendor', targetEntity: Product::class)]
    private Collection $products;

    #[ORM\OneToOne(
        inversedBy: 'marketPlaceVendor',
        targetEntity: MarketPlaceVendorAddress::class,
        cascade: ['persist', 'remove']
    )]
    private MarketPlaceVendorAddress $marketPlaceVendorAddress;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $state = self::CREATED;

    #[ORM\OneToOne(
        mappedBy: 'MarketPlaceVendor',
        targetEntity: MarketPlaceBankAccount::class,
        cascade: ['persist', 'remove']
    )]
    private ?MarketPlaceBankAccount $marketPlaceBankAccount;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getUser(): ?ShopUser
    {
        return $this->user;
    }

    public function setUser(?ShopUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setMarketPlaceVendor($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getMarketPlaceVendor() === $this) {
                $product->setMarketPlaceVendor(null);
            }
        }

        return $this;
    }

    public function getMarketPlaceVendorAddress(): ?MarketPlaceVendorAddress
    {
        return $this->marketPlaceVendorAddress;
    }

    public function setMarketPlaceVendorAddress(?MarketPlaceVendorAddress $marketPlaceVendorAddress): self
    {
        $this->marketPlaceVendorAddress = $marketPlaceVendorAddress;

        return $this;
    }

    public function getMarketPlaceBankAccount(): ?MarketPlaceBankAccount
    {
        return $this->marketPlaceBankAccount;
    }

    public function setMarketPlaceBankAccount(?MarketPlaceBankAccount $marketPlaceBankAccount): self
    {
        // unset the owning side of the relation if necessary
        if ($marketPlaceBankAccount === null && $this->marketPlaceBankAccount !== null) {
            $this->marketPlaceBankAccount->setMarketPlaceVendor(null);
        }

        // set the owning side of the relation if necessary
        if ($marketPlaceBankAccount !== null && $marketPlaceBankAccount->getMarketPlaceVendor() !== $this) {
            $marketPlaceBankAccount->setMarketPlaceVendor($this);
        }

        $this->marketPlaceBankAccount = $marketPlaceBankAccount;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }
}
