<?php

namespace App\Domain\MarketPlace\Factory;

use App\Domain\MarketPlace\Entity\MarketPlaceProduct;
use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use App\Entity\Product\Product;
use Sylius\Component\Product\Factory\ProductFactoryInterface;

final class MarketPlaceProductFactory
{
    public function __construct(
        private ProductFactoryInterface $productFactory
    ) {
    }

    public function create(): MarketPlaceProduct
    {
        $marketPlaceProduct = new MarketPlaceProduct();
        /** @var Product $product */
        $product = $this->productFactory->createWithVariant();
        $marketPlaceProduct->setProduct($product);

        return $marketPlaceProduct;
    }

    public function createWithData(
        MarketPlaceVendor $marketPlaceVendor
    ): MarketPlaceProduct {
        $marketPlaceProduct = $this->create();

        $marketPlaceProduct->setMarketPlaceVendor($marketPlaceVendor);

        return $marketPlaceProduct;
    }
}
