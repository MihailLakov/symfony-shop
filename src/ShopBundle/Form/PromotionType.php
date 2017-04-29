<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ShopBundle\Entity\PromoType;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Promotion;
class PromotionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('percentage', IntegerType::class)
                ->add('start_date', DateTimeType::class)
                ->add('end_date', DateTimeType::class)               
                ->add('promo_type', EntityType::class, array(
                    'class' => PromoType::class,
                    'choice_label' => 'title',
        ))
                ->add('product', EntityType::class, array(
                    'class' => Product::class,
                    'choice_label' => 'title',
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\Promotion'
                )
        );
    }

}
