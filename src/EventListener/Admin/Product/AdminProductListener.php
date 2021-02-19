<?php


namespace App\EventListener\Admin\Product;


use App\Entity\Product\ProductCategory;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class AdminProductListener
{

    public function prePersist(ProductCategory $productCategory, LifecycleEventArgs $lifecycleEventArgs): void
    {
        if ($productCategory instanceof ProductCategory && $productCategory->getProductCategory() !== null) {
            $this->updateProductCategory($productCategory->getProductCategory());
        }
    }

    public function preUpdate(ProductCategory $productCategory, LifecycleEventArgs $lifecycleEventArgs)
    {
        if ($productCategory instanceof ProductCategory && $productCategory->getProductCategory() !== null) {
            $this->updateProductCategory($productCategory->getProductCategory());
        }
    }

    private function updateProductCategory(ProductCategory $productCategory)
    {
        $productCategory->setPrimaryCategory(1);
    }
}