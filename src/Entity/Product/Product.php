<?php

declare(strict_types=1);

namespace App\Entity\Product;

use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductTranslationInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product')]
class Product extends BaseProduct
{
    #[ORM\ManyToOne(targetEntity: MarketPlaceVendor::class, inversedBy: 'products')]
    private ?MarketPlaceVendor $marketplaceVendor;

    protected function createTranslation(): ProductTranslationInterface
    {
        return new ProductTranslation();
    }

    public function getMarketPlaceVendor(): ?MarketPlaceVendor
    {
        return $this->marketplaceVendor;
    }

    public function setMarketPlaceVendor(?MarketPlaceVendor $marketplaceVendor): self
    {
        $this->marketplaceVendor = $marketplaceVendor;

        return $this;
    }
}
