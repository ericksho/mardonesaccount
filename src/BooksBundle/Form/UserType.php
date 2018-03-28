<?php

namespace BooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,array('label' => 'Nombre','attr' => array('class'=>'form-control')))
            ->add('lastname', null,array('label' => 'Apellido','attr' => array('class'=>'form-control')))
            ->add('rut', null,array('label' => 'Rut (sin puntos)', 'required' => true,'attr' => array('class'=>'form-control')))
            ->add('email', EmailType::class,array('label' => 'Email','attr' => array('class'=>'form-control')))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña/Password','attr' => array('disabled' => false, 'class'=>'form-control')),
                'second_options' => array('label' => 'Repita Contraseña/Repeat Password','attr' => array('disabled' => false, 'class'=>'form-control')),
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BooksBundle\Entity\User',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'booksbundle_user';
    }


}
