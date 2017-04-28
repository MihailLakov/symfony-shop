<?php
namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserEditType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name',TextType::class)   
                ->add('email', EmailType::class)
                ->add('balance', IntegerType::class)
                ->add('isActive', ChoiceType::class,
                        [
                            'choices' => array(
                                'Yes' => true,
                                'No' => false,
                                )
                        ]);
                
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
                    'data_class' => 'ShopBundle\Entity\User'
                    )
                );
    }
}
