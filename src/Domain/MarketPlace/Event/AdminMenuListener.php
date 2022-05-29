<?php

namespace App\Domain\MarketPlace\Event;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class AdminMenuListener
{
    /**
     * @param MenuBuilderEvent $event
     */
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $newSubmenu = $menu
            ->addChild('new')
            ->setLabel('Marketplace')
        ;

        $newSubmenu
            ->addChild('new-subitem', ['route' => "app_admin_market_place_vendor_index"])
            ->setLabel('Vendors')
            ->setLabelAttribute('icon', 'user')
        ;
    }
}
