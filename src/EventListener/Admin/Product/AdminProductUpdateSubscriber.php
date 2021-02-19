<?php


namespace App\EventListener\Admin\Product;


use App\Entity\Product\ProductAttributeValue;
use App\Entity\Product\ProductOptionValue;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class AdminProductUpdateSubscriber implements EventSubscriber
{

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate,
        ];
    }

    public function preUpdate(LifecycleEventArgs $lifecycleEventArgs)
    {
        $entity = $lifecycleEventArgs->getObject();
        if ($entity instanceof ProductAttributeValue || $entity instanceof ProductOptionValue) {
            return;
        }
        $entity->setUpdatedAt(new DateTime());
    }
}