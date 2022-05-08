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

}