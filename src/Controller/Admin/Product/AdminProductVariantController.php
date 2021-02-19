<?php

namespace App\Controller\Admin\Product;

use App\Controller\RouteName;
use App\Entity\Product\ProductVariant;
use App\Form\Product\ProductVariantType;
use App\Repository\Product\ProductVariantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product/product/variant')]
class AdminProductVariantController extends AbstractController
{
    #[Route('/', name: RouteName::ADMIN_PRODUCT_VARIANT_INDEX, methods: ['GET'])]
    public function index(ProductVariantRepository $productVariantRepository): Response
    {
        return $this->render('admin/product/product_variant/index.html.twig', [
            'product_variants' => $productVariantRepository->findAll(),
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_VARIANT_NEW),
            'path_label' => 'Create',
            'header_title' => 'Product Variants',
        ]);
    }

    #[Route('/new', name: RouteName::ADMIN_PRODUCT_VARIANT_NEW, methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $productVariant = new ProductVariant();
        $form = $this->createForm(ProductVariantType::class, $productVariant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productVariant);
            $entityManager->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_VARIANT_INDEX);
        }

        return $this->render('admin/product/product_variant/new.html.twig', [
            'product_variant' => $productVariant,
            'form' => $form->createView(),
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_VARIANT_INDEX),
            'header_title' => 'New Product Variant',
            'button' => true,
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_VARIANT_SHOW, methods: ['GET'])]
    public function show(ProductVariant $productVariant): Response
    {
        return $this->render('admin/product/product_variant/show.html.twig', [
            'product_variant' => $productVariant,
        ]);
    }

    #[Route('/{id}/edit', name: RouteName::ADMIN_PRODUCT_VARIANT_EDIT, methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductVariant $productVariant): Response
    {
        $form = $this->createForm(ProductVariantType::class, $productVariant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_VARIANT_INDEX);
        }

        return $this->render('admin/product/product_variant/edit.html.twig', [
            'product_variant' => $productVariant,
            'form' => $form->createView(),
            'button' => true,
            'button_label' => 'Update',
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_VARIANT_INDEX),
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_VARIANT_DELETE, methods: ['DELETE'])]
    public function delete(Request $request, ProductVariant $productVariant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productVariant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productVariant);
            $entityManager->flush();
        }

        return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_VARIANT_INDEX);
    }
}
