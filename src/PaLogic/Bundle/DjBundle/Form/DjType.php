<?php

namespace PaLogic\Bundle\DjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PaLogic\Bundle\ImageBundle\Entity\Repository\ImageRepository;

class DjType extends AbstractType
{
    
    private $user;
    
    public function __construct($user)
    {
        $this->user = $user;
    }
    
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
                'palogic_imagebundle_images',
                array(
                    'label' => 'Anzeigebild',
                    'class' => 'PaLogic\Bundle\ImageBundle\Entity\Image',
                    'query_builder' => function(ImageRepository $repository) {
                        return $repository->createQueryBuilder('i')
                            ->where('i.owner = :user')
                            ->setParameter('user', $this->user)
                        ;
                    },
                    'required' => true,
                    'option_attributes' => array('data-img-src' => 'webPath'), 
                )
            )
            ->add(
                'images',
                'palogic_imagebundle_images',
                array(
                    'label' => 'Bilder',
                    'class' => 'PaLogic\Bundle\ImageBundle\Entity\Image',
                    'query_builder' => function(ImageRepository $repository) {
                        return $repository->createQueryBuilder('i')
                            ->where('i.owner = :user')
                            ->setParameter('user', $this->user)
                        ;
                    },
                    'required' => true,
                    'multiple' => true,
                    'option_attributes' => array('data-img-src' => 'webPath'), 
                )
            )
            ->add('genres', 'genres', array(
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
