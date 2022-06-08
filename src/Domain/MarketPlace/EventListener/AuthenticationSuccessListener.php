<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Domain\MarketPlace\EventListener;

use ApiPlatform\Core\Api\IriConverterInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\ShopUserInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class AuthenticationSuccessListener
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof ShopUserInterface) {
            return;
        }

        /** @var CustomerInterface $customer */
        $customer = $user->getCustomer();

        $data['customer'] = $this->serializer->normalize($customer, null, ['groups' => 'shop:customer:read']);

        $event->setData($data);
    }
}
