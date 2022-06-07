<?php

declare(strict_types=1);

namespace App\Entity\Product;

use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ProductVariant as BaseProductVariant;
use Sylius\Component\Product\Model\ProductVariantTranslationInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product_variant')]
class ProductVariant extends BaseProductVariant
{
    #[ORM\ManyToOne(targetEntity: MarketPlaceVendor::class, inversedBy: 'productVariants')]
    private ?MarketPlaceVendor $marketPlaceVendor;

    protected function createTranslation(): ProductVariantTranslationInterface
    {
        return new ProductVariantTranslation();
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
}
