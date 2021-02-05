<?php

namespace App\Form\Product;

use App\Entity\Product\ProductAttribute;
use App\Entity\Product\ProductAttributeValue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductAttributeValueType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('textValue', TextType::class)
            ->add('attribute', EntityType::class, [
                'class' => ProductAttribute::class,
                'label' => false,
                'attr' => [
                    'hidden' => true,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductAttributeValue::class,
        ]);
    }
}
