<?php
namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
class CategoryType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title',TextType::class)
                ->add('description',  TextareaType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
                    'data_class' => 'ShopBundle\Entity\Category'
                    )
                );
    }
}
