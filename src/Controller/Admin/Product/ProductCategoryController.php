<?php

namespace App\Controller\Admin\Product;

use App\Controller\RouteName;
use App\Entity\Product\ProductCategory;
use App\Form\Product\ProductCategoryType;
use App\Repository\Product\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/product_category')]
class ProductCategoryController extends AbstractController
{
    #[Route('/', name: RouteName::ADMIN_PRODUCT_CATEGORY_INDEX, methods: ['GET'])]
    public function index(ProductCategoryRepository $productCategoryRepository): Response
    {
        return $this->render('admin/product/product_category/index.html.twig', [
            'product_categories' => $productCategoryRepository->findAll(),
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_CATEGORY_NEW),
            'path_label' => 'Create',
            'header_title' => 'Product Category',
        ]);
    }

    #[Route('/new', name: RouteName::ADMIN_PRODUCT_CATEGORY_NEW, methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $productCategory = new ProductCategory();
        $form = $this->createForm(ProductCategoryType::class, $productCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productCategory);
            $entityManager->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_CATEGORY_INDEX);
        }

        return $this->render('admin/product/product_category/new.html.twig', [
            'product_category' => $productCategory,
            'form' => $form->createView(),
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_CATEGORY_INDEX),
            'header_title' => 'New Product Category',
            'button' => true,
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_CATEGORY_SHOW, methods: ['GET'])]
    public function show(ProductCategory $productCategory): Response
    {
        return $this->render('admin/product/product_category/show.html.twig', [
            'product_category' => $productCategory,
        ]);
    }

    #[Route('/{id}/edit', name: RouteName::ADMIN_PRODUCT_CATEGORY_EDIT, methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductCategory $productCategory): Response
    {
        $form = $this->createForm(ProductCategoryType::class, $productCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_CATEGORY_INDEX);
        }

        return $this->render('admin/product/product_category/edit.html.twig', [
            'product_category' => $productCategory,
            'form' => $form->createView(),
            'button' => true,
            'button_label' => 'Update',
            'path' => $this->generateUrl(RouteName::ADMIN_PRODUCT_CATEGORY_INDEX),
        ]);
    }

    #[Route('/{id}', name: RouteName::ADMIN_PRODUCT_CATEGORY_DELETE, methods: ['DELETE'])]
    public function delete(Request $request, ProductCategory $productCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute(RouteName::ADMIN_PRODUCT_CATEGORY_INDEX);
    }
}
