<?php

namespace BooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VoucherType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('state', ChoiceType::class,array('choices'  => array(
                'Vigente' => 'Vigente',
                'Nulo' => 'Nulo', 
                'Pendiente' => 'Pendiente', 
                'Vigente-nulo' => 'Vigente-nulo'
                ),'label' => 'Estado','attr' => array('class'=>'js-basic-single')))
            ->add('type', ChoiceType::class,array('choices'  => array(
                'Ingreso' => 'Ingreso',
                'Egreso' => 'Egreso', 
                'Traspasos' => 'Traspasos', 
                ),'label' => 'Tipo','attr' => array('class'=>'js-basic-single')))
            ->add('number', null,array('label' => 'Número','attr' => array('class'=>'form-control')))
            ->add('date', 'date', array('widget' => 'single_text', 'attr' => array('class'=>'form-control right-column-form'), 'label' => 'Fecha'))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BooksBundle\Entity\Voucher'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'booksbundle_voucher';
    }


}
