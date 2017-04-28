<?php

namespace ShopBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ShopBudnle\Entity\Tag;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('name');
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(
            [
                'data_class' => Tag::class
            ]
        );
    }

    public function getName() {
        return 'app_bundle_tag_type';
    }
}
