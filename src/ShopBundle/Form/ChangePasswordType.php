<?php
namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('oldPassword', PasswordType::class);
        $builder->add('newPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'required' => true,
            'invalid_message' => 'The password fields must match.',
            'options' => array('attr' => array('class' => 'password-field')),
            'first_options'  => array('label' => 'New Password'),
            'second_options' => array('label' => 'Repeat New Password'),
            
        ));
        
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
                    'data_class' => 'ShopBundle\Model\ChangePasswordModel'
                    )
                );
    }
}
