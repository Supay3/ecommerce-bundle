<?php

namespace App\Controller;

use App\Repository\Product\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: RouteName::HOME)]
    public function index(ProductCategoryRepository $productCategoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'productCategories' => $productCategoryRepository->findPrimaryCategories(),
        ]);
    }
}
