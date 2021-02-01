<?php

namespace App\Controller\Admin\Product;

use App\Controller\RouteName;
use App\Entity\Product\ProductOption;
use App\Form\Product\ProductOptionType;
use App\Repository\Product\ProductOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/product_option')]
class AdminProductOptionController extends AbstractController
{
    #[Route('/', name: RouteName::ADMIN_PRODUCT_OPTION_INDEX, methods: ['GET'])]
    public function index(ProductOptionRepository $productOptionRepository): Response
    {
        return $this->render('admin/product/product_option/index.html.twig', [
            'product_options' => $productOptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: RouteName::ADMIN_PRODUCT_OPTION_NEW, methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $productOption = new ProductOption();
        $form = $this->createForm(ProductOptionType::class, $productOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productOption);
            $entityManager->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_OPTION_INDEX);
        }

        return $this->render('admin/product/product_option/new.html.twig', [
            'product_option' => $productOption,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_OPTION_SHOW, methods: ['GET'])]
    public function show(ProductOption $productOption): Response
    {
        return $this->render('admin/product/product_option/show.html.twig', [
            'product_option' => $productOption,
        ]);
    }

    #[Route('/{id}/edit', name: RouteName::ADMIN_PRODUCT_OPTION_EDIT, methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductOption $productOption): Response
    {
        $form = $this->createForm(ProductOptionType::class, $productOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_OPTION_INDEX);
        }

        return $this->render('admin/product/product_option/edit.html.twig', [
            'product_option' => $productOption,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_OPTION_DELETE, methods: ['DELETE'])]
    public function delete(Request $request, ProductOption $productOption): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productOption->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_OPTION_INDEX);
    }
}
