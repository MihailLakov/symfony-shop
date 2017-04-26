<?php
namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\MoneyType;
use \Symfony\Component\Form\Extension\Core\Type\IntegerType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use \Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\Brand;
class ProductType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title',TextType::class);
        $builder->add('description',  TextareaType::class);
        $builder->add('price',  MoneyType::class, array(
            'currency'=>'BGN'
        ));
        $builder->add('stock',IntegerType::class);
        $builder->add('image',  FileType::class, array(
            'data_class' => null,
            'required' => false
        ));
        $builder->add('published', CheckboxType::class, array(
            'required' => false
        ));
        $builder->add('category', EntityType::class,array(
             'class' => Category::class,
             'choice_label' => 'title',
        ));
        $builder->add('brand', EntityType::class,array(
             'class' => Brand::class,
             'choice_label' => 'title',
        ));
        
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
                    'data_class' => 'ShopBundle\Entity\Product'
                    )
                );
    }
}
