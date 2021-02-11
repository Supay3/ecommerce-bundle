<?php

namespace App\Controller\Admin\Product;

use App\Controller\RouteName;
use App\Entity\Product\ProductAttribute;
use App\Form\Product\ProductAttributeType;
use App\Repository\Product\ProductAttributeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/product_attribute')]
class AdminProductAttributeController extends AbstractController
{
    #[Route('/', name: RouteName::ADMIN_PRODUCT_ATTRIBUTE_INDEX, methods: ['GET'])]
    public function index(ProductAttributeRepository $productAttributeRepository): Response
    {
        return $this->render('admin/product/product_attribute/index.html.twig', [
            'product_attributes' => $productAttributeRepository->findAll(),
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_ATTRIBUTE_NEW),
            'path_label' => 'Create',
            'header_title' => 'Product Attributes',
        ]);
    }

    #[Route('/new', name: RouteName::ADMIN_PRODUCT_ATTRIBUTE_NEW, methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $productAttribute = new ProductAttribute();
        $form = $this->createForm(ProductAttributeType::class, $productAttribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productAttribute);
            $entityManager->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_ATTRIBUTE_INDEX);
        }

        return $this->render('admin/product/product_attribute/new.html.twig', [
            'product_attribute' => $productAttribute,
            'form' => $form->createView(),
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_ATTRIBUTE_INDEX),
            'header_title' => 'New Product Attribute',
            'button' => true,
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_ATTRIBUTE_SHOW, methods: ['GET'])]
    public function show(ProductAttribute $productAttribute): Response
    {
        return $this->render('admin/product/product_attribute/show.html.twig', [
            'product_attribute' => $productAttribute,
        ]);
    }

    #[Route('/{id}/edit', name: RouteName::ADMIN_PRODUCT_ATTRIBUTE_EDIT, methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductAttribute $productAttribute): Response
    {
        $form = $this->createForm(ProductAttributeType::class, $productAttribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_ATTRIBUTE_INDEX);
        }

        return $this->render('admin/product/product_attribute/edit.html.twig', [
            'product_attribute' => $productAttribute,
            'form' => $form->createView(),
            'button' => true,
            'button_label' => 'Update',
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_ATTRIBUTE_INDEX),
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_ATTRIBUTE_DELETE, methods: ['DELETE'])]
    public function delete(Request $request, ProductAttribute $productAttribute): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productAttribute->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productAttribute);
            $entityManager->flush();
        }

        return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_ATTRIBUTE_INDEX);
    }
}
