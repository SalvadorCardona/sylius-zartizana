<?php

namespace App\Domain\Marketplace\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Marketplace\Repository\MarketplaceVendorRepository;
use App\Entity\Product\Product;
use App\Entity\User\ShopUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: MarketplaceVendorRepository::class)]
#[ApiResource]
class MarketplaceVendor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid', unique: true)]
    private ?Uuid $id;

    #[ORM\OneToOne(inversedBy: 'marketplaceVendor', targetEntity: ShopUser::class, cascade: ['persist', 'remove'])]
    private ?ShopUser $user;

    /** @var Collection<int, Product> */
    #[ORM\OneToMany(mappedBy: 'marketplaceVendor', targetEntity: Product::class)]
    private Collection $products;

    #[ORM\OneToOne(mappedBy: 'marketplaceVendor', targetEntity: MarketPlaceVendorAddress::class, cascade: ['persist', 'remove'])]
    private ?MarketPlaceVendorAddress $marketPlaceVendorAddress;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
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
            $product->setMarketplaceVendor($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getMarketplaceVendor() === $this) {
                $product->setMarketplaceVendor(null);
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
        // unset the owning side of the relation if necessary
        if ($marketPlaceVendorAddress === null && $this->marketPlaceVendorAddress !== null) {
            $this->marketPlaceVendorAddress->setMarketplaceVendor(null);
        }

        // set the owning side of the relation if necessary
        if ($marketPlaceVendorAddress !== null && $marketPlaceVendorAddress->getMarketplaceVendor() !== $this) {
            $marketPlaceVendorAddress->setMarketplaceVendor($this);
        }

        $this->marketPlaceVendorAddress = $marketPlaceVendorAddress;

        return $this;
    }
}
