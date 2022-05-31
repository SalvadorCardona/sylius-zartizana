<?php

namespace App\Domain\MarketPlace\Controller;

use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use App\Entity\Product\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevController extends AbstractController
{
    #[Route('/dev', name: 'app_dev')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $productManager = $entityManager->getRepository(Product::class);
        $marketPlaceVendorManager = $entityManager->getRepository(MarketPlaceVendor::class);


        $vendor = $marketPlaceVendorManager->findAll()[0];
        $product = $productManager->findAll()[0];

        $product->setMarketPlaceVendor($vendor);

        $entityManager->flush();

        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
        ]);
    }
}
