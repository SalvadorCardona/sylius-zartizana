<?php

namespace App\Domain\MarketPlace\Controller;

use App\Domain\MarketPlace\Entity\MarketPlaceVendor;
use App\Entity\Product\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Mailer\Sender\SenderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevController extends AbstractController
{
    #[Route('/dev', name: 'app_dev')]
    public function index(SenderInterface $sender): Response
    {
        $sender
            ->send(
                'movie_added_notification',
                ['team@website.com'],
            );
        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
        ]);
    }
}
