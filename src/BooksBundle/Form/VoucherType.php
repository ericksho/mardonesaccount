<?php

namespace BooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
            ->add('items', CollectionType::class, array(
                'entry_type' => ItemType::class,    
                'entry_options' => array(
                    'attr' => array(
                        'class' => 'item', // we want to use 'tr.item' as collection elements' selector
                    ),),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype'    => true,
                'required'     => false,
                'by_reference' => true,
                'delete_empty' => true,
                'attr' => array('class'=>'table discount-collection')))
            ->add('save', SubmitType::class, ['label' => 'Guardar'])
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
