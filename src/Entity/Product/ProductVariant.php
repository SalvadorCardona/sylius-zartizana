<?php

declare(strict_types=1);

namespace App\Entity\Product;

use App\Domain\MarketPlace\Entity\MarketPlaceProduct;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ProductVariant as BaseProductVariant;
use Sylius\Component\Product\Model\ProductVariantTranslationInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product_variant')]
class ProductVariant extends BaseProductVariant
{
    /** @var Collection<int, MarketPlaceProduct> */
    #[ORM\ManyToMany(targetEntity: MarketPlaceProduct::class, mappedBy: 'ProductVariant')]
    private Collection $marketPlaceProducts;

    public function __construct()
    {
        parent::__construct();
        $this->marketPlaceProducts = new ArrayCollection();
    }

    protected function createTranslation(): ProductVariantTranslationInterface
    {
        return new ProductVariantTranslation();
    }

    /**
     * @return Collection<int, MarketPlaceProduct>
     */
    public function getMarketPlaceProducts(): Collection
    {
        return $this->marketPlaceProducts;
    }

    public function addMarketPlaceProduct(MarketPlaceProduct $marketPlaceProduct): self
    {
        if (!$this->marketPlaceProducts->contains($marketPlaceProduct)) {
            $this->marketPlaceProducts[] = $marketPlaceProduct;
            $marketPlaceProduct->addProductVariant($this);
        }

        return $this;
    }

    public function removeMarketPlaceProduct(MarketPlaceProduct $marketPlaceProduct): self
    {
        if ($this->marketPlaceProducts->removeElement($marketPlaceProduct)) {
            $marketPlaceProduct->removeProductVariant($this);
        }

        return $this;
    }
}
