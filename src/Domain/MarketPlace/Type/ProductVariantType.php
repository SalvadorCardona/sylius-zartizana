<?php

namespace App\Domain\MarketPlace\Type;

use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductVariantType extends AbstractTypeExtension
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder->add('marketPlaceVendor', EntityType::class, [
            'required' => false,
            'class' => MarketPlaceVendor::class,
            'choice_label' => function ($marketPlaceVendor) {
                return $marketPlaceVendor->getUser()->getEmail();
            }
        ])
        ;
    }

    public function getExtendedType(): string
    {
        return \Sylius\Bundle\ProductBundle\Form\Type\ProductVariantType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [\Sylius\Bundle\ProductBundle\Form\Type\ProductVariantType::class];
    }
}
