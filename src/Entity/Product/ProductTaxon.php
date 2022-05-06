<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ProductTaxon as BaseProductTaxon;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product_taxon')]
class ProductTaxon extends BaseProductTaxon
{
    #[Groups(['shop:product:read', 'list_product'])]
    protected $id;
}
