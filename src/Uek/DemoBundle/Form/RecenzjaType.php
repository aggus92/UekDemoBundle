<?php

namespace Uek\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecenzjaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tresc', 'textarea', array('label' => 'Treść'))
            ->add('idfilmu', 'entity', array(
			'class' => 'Uek\DemoBundle\Entity\Filmy',
			'property' => 'tytulfilmu',
			'label' => 'Tytuł filmu',
			))
			->add('save', 'submit', array(
			'label' => 'Dodaj recenzję',
			'attr' => array(
				'class' => 'btn btn-primary'
				)
			))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uek\DemoBundle\Entity\Recenzje'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}