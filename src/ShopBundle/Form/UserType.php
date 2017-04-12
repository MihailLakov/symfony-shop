<?php
namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name',TextType::class);
        $builder->add('password', PasswordType::class);
        $builder->add('email', EmailType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
                    'data_class' => 'ShopBundle\Entity\User'
                    )
                );
    }
}
