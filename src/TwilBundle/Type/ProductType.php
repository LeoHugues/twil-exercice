<?php

namespace TwilBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('name', "text")
            ->add('Enregistrer', 'submit')
            ->getForm();
        ;
    }
    
    public function getName()
    {
        return "product";
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TwilBundle\Entity\Product',
        ));
    }
}
