<?php

namespace ShopBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ShopBundle\Entity\Review;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)  {
        $builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            [
                'data_class' => Review::class
            ]
        );
    }

    public function getName(){
        return 'app_bundle_review_type';
    }
}
