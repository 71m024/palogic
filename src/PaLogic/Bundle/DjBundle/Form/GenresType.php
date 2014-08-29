<?php

namespace PaLogic\Bundle\DjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use PaLogic\Bundle\DjBundle\Form\DataTransformer\GenresDataTransformer;

class GenresType extends AbstractType
{
    
    /**
     * Ctor.
     *
     * @param RegistryInterface        $registry        A RegistryInterface instance
     * @param SecurityContextInterface $securityContext A SecurityContextInterface instance
     */
    public function __construct(RegistryInterface $registry, SecurityContextInterface $securityContext)
    {
        $this->registry = $registry;
        $this->securityContext = $securityContext;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(
            new GenresDataTransformer(
                $this->registry,
                $this->securityContext
            ),
            true
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'genres';
    }
}
