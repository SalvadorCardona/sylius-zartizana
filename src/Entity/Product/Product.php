<?php

declare(strict_types=1);

namespace App\Entity\Product;

use App\Domain\MarketPlace\Entity\MarketPlaceProduct;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductTranslationInterface;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product')]
class Product extends BaseProduct
{
    /** @var Collection<int, MarketPlaceProduct> */
    #[ORM\OneToMany(mappedBy: 'Product', targetEntity: MarketPlaceProduct::class)]
    private Collection $marketPlaceProducts;

    public function __construct()
    {
        parent::__construct();
        $this->marketPlaceProducts = new ArrayCollection();
    }

    protected function createTranslation(): ProductTranslationInterface
    {
        return new ProductTranslation();
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
            $marketPlaceProduct->setProduct($this);
        }

        return $this;
    }

    public function removeMarketPlaceProduct(MarketPlaceProduct $marketPlaceProduct): self
    {
        if ($this->marketPlaceProducts->removeElement($marketPlaceProduct)) {
            // set the owning side to null (unless already changed)
            if ($marketPlaceProduct->getProduct() === $this) {
                $marketPlaceProduct->setProduct(null);
            }
        }

        return $this;
    }
}
