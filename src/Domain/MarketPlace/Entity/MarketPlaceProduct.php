<?php

namespace App\Domain\MarketPlace\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\MarketPlace\Repository\MarketPlaceProductRepository;
use App\Entity\Product\Product;
use App\Entity\Product\ProductVariant;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarketPlaceProductRepository::class)]
#[ApiResource(
    collectionOperations: [
        'create_marketplace_product' => [
            'method' => 'POST',
            'path' => '/shop/product/create',
            'denormalization_context' => ['groups' => 'shop:create:marketplace_product'],
            'output' => false,
        ],
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN')"
        ]
    ]
)]
class MarketPlaceProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'marketPlaceProducts')]
    private ?Product $Product;

    /** @var Collection<array-key, ProductVariant> */
    #[ORM\ManyToMany(targetEntity: ProductVariant::class, inversedBy: 'marketPlaceProducts')]
    private Collection $ProductVariant;

    #[ORM\ManyToOne(targetEntity: MarketPlaceVendor::class, inversedBy: 'marketPlaceProducts')]
    private ?MarketPlaceVendor $MarketPlaceVendor;

    public function __construct()
    {
        $this->ProductVariant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->Product;
    }

    public function setProduct(?Product $Product): self
    {
        $this->Product = $Product;

        return $this;
    }

    /**
     * @return Collection<array-key, ProductVariant>
     */
    public function getProductVariant(): Collection
    {
        return $this->ProductVariant;
    }

    public function addProductVariant(ProductVariant $productVariant): self
    {
        if (!$this->ProductVariant->contains($productVariant)) {
            $this->ProductVariant[] = $productVariant;
        }

        return $this;
    }

    public function removeProductVariant(ProductVariant $productVariant): self
    {
        $this->ProductVariant->removeElement($productVariant);

        return $this;
    }

    public function getMarketPlaceVendor(): ?MarketPlaceVendor
    {
        return $this->MarketPlaceVendor;
    }

    public function setMarketPlaceVendor(?MarketPlaceVendor $MarketPlaceVendor): self
    {
        $this->MarketPlaceVendor = $MarketPlaceVendor;

        return $this;
    }
}
