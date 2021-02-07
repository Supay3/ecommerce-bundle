<?php

namespace App\Controller\Admin\Product;

use App\Controller\RouteName;
use App\Entity\Product\Product;
use App\Form\Product\ProductType;
use App\Repository\Product\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/product')]
class AdminProductController extends AbstractController
{
    #[Route('/', name: RouteName::ADMIN_PRODUCT_INDEX, methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin/product/product/index.html.twig', [
            'products' => $productRepository->findAll(),
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_NEW),
            'path_label' => 'Create',
            'header_title' => 'Products',
        ]);
    }

    #[Route('/new', name: RouteName::ADMIN_PRODUCT_NEW, methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_INDEX);
        }

        return $this->render('admin/product/product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_INDEX),
            'header_title' => 'New Product',
            'button' => true,
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_SHOW, methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('admin/product/product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: RouteName::ADMIN_PRODUCT_EDIT, methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_INDEX);
        }

        return $this->render('admin/product/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'button' => true,
            'button_label' => 'Update',
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_INDEX),
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_DELETE, methods: ['DELETE'])]
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_INDEX);
    }
}
