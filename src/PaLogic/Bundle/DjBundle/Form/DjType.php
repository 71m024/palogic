<?php

namespace PaLogic\Bundle\DjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DjType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('phone')
            ->add('email', 'email')
            ->add('description')
            ->add(
                'headshot',
                'palogic_appbundle_images',
                array(
                    'label' => 'Anzeigebild',
                    'class' => 'PaLogic\Bundle\AppBundle\Entity\Image',
                    'required' => true,
                    'option_attributes' => array('data-img-src' => 'webPath'), 
                )
            )
            ->add(
                'images',
                'palogic_appbundle_images',
                array(
                    'label' => 'Bilder',
                    'class' => 'PaLogic\Bundle\AppBundle\Entity\Image',
                    'required' => true,
                    'multiple' => true,
                    'option_attributes' => array('data-img-src' => 'webPath'), 
                )
            )
            ->add('genres', 'genre', array(
                'label' => 'Genres',
                'required' => false)
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PaLogic\Bundle\DjBundle\Entity\Dj'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'palogic_bundle_djbundle_dj';
    }
}
