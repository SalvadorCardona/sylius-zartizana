<?php

declare(strict_types=1);

namespace App\Entity\Product;

use App\Domain\Marketplace\Entity\MarketplaceVendor;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductTranslationInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product')]
class Product extends BaseProduct
{
    #[ORM\ManyToOne(targetEntity: MarketplaceVendor::class, inversedBy: 'products')]
    private ?MarketplaceVendor $marketplaceVendor;

    protected function createTranslation(): ProductTranslationInterface
    {
        return new ProductTranslation();
    }

    public function getMarketplaceVendor(): ?MarketplaceVendor
    {
        return $this->marketplaceVendor;
    }

    public function setMarketplaceVendor(?MarketplaceVendor $marketplaceVendor): self
    {
        $this->marketplaceVendor = $marketplaceVendor;

        return $this;
    }
}
