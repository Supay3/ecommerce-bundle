<?php

namespace App\Form\Product;

use App\Entity\Product\Product;
use App\Entity\Product\ProductAttribute;
use App\Entity\Product\ProductOption;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
            ])
            ->add('price', MoneyType::class, [
                'required' => true,
            ])
            ->add('description')
            ->add('stock', IntegerType::class, [
                'empty_data' => 0,
                'attr' => [
                    'placeholder' => '0',
                ],
                'required' => true,
            ])
            ->add('productOptions', EntityType::class, [
                'class' => ProductOption::class,
                'multiple' => true,
                'required' => false,
            ])
            ->add('productAttribute', EntityType::class, [
                'class' => ProductAttribute::class,
                'mapped' => false,
                'multiple' => true,
                'required' => false,
            ])
            ->add('productAttributeValues', CollectionType::class, [
                'entry_type' => ProductAttributeValueType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
