<?php

declare(strict_types=1);

namespace App\Entity\User;

use App\Entity\Marketplace\MarketplaceVendor;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ShopUser as BaseShopUser;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_shop_user')]
class ShopUser extends BaseShopUser
{
    #[ORM\OneToOne(mappedBy: 'user', targetEntity: MarketplaceVendor::class, cascade: ['persist', 'remove'])]
    private ?MarketplaceVendor $marketplaceVendor;

    public function getMarketplaceVendor(): ?MarketplaceVendor
    {
        return $this->marketplaceVendor;
    }

    public function setMarketplaceVendor(?MarketplaceVendor $marketplaceVendor): self
    {
        // unset the owning side of the relation if necessary
        if ($marketplaceVendor === null && $this->marketplaceVendor !== null) {
            $this->marketplaceVendor->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($marketplaceVendor !== null && $marketplaceVendor->getUser() !== $this) {
            $marketplaceVendor->setUser($this);
        }

        $this->marketplaceVendor = $marketplaceVendor;

        return $this;
    }
}
