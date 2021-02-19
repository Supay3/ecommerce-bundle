<?php

namespace App\Form\Product;

use App\Entity\Product\Product;
use App\Entity\Product\ProductVariant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductVariantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', MoneyType::class, [
                'required' => true,
            ])
            ->add('stock', IntegerType::class, [
                'empty_data' => 0,
                'attr' => [
                    'placeholder' => 0,
                ],
                'required' => true,
            ])
            ->add('width', NumberType::class, [
                'required' => false,
            ])
            ->add('height', NumberType::class, [
                'required' => false,
            ])
            ->add('depth', NumberType::class, [
                'required' => false,
            ])
            ->add('weight', NumberType::class, [
                'required' => false,
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'required' => true,
            ])
            ->add('productOptionValues')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductVariant::class,
            'attr' => [
                'class' => 'admin-form',
                'id' => 'product-option-form',
            ],
        ]);
    }
}
