<?php

namespace BooksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AccountL1Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array('label' => 'Nombre','attr' => array('class'=>'form-control')))
            ->add('code', null,array('label' => 'Código','attr' => array('class'=>'form-control')))
            ->add('enterprise', EntityType::class, array(
                        'label' => 'Empresa',
                        'required' => false,
                        'class' => 'BooksBundle:Enterprise',
                        'multiple' => false,
                        'attr' => array('class'=>'js-basic-single'),
                        'choice_label' => 'name',))

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BooksBundle\Entity\AccountL1'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'booksbundle_accountl1';
    }


}
