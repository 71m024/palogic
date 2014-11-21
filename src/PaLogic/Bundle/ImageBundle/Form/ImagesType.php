<?php

namespace PaLogic\Bundle\ImageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;

class ImagesType extends AbstractType
{
    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;
    
    /**
     *
     * @var type CacheManager;
     */
    private $cacheManager;

    /**
     * @param PropertyAccessorInterface $propertyAccessor
     */
    function __construct(PropertyAccessorInterface $propertyAccessor, CacheManager $cacheManager)
    {
        $this->propertyAccessor = $propertyAccessor;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        parent::finishView($view, $form, $options);

        foreach ($view->vars['choices'] as $choice) {
            $additionalAttributes = array();
            foreach ($options['option_attributes'] as $attributeName => $choicePath) {
                
                /* generate a thumbnail image if the option_attribute is an image-path */
                if ($attributeName == 'data-img-src') {
                    $webPath = $this->propertyAccessor->getValue($choice->data, $choicePath);
                    $runtimeConfig = array(
                        "relative_resize" => array(
                            "widen" => 109
                        )
                    );
                    $value = $this->cacheManager->getBrowserPath($webPath, 'filter_widen', $runtimeConfig);
                } else {
                    $value = $this->propertyAccessor->getValue($choice->data, $choicePath);
                }
                
                $additionalAttributes[$attributeName] = $value;
            }

            $choice->attr = array_replace(isset($choice->attr) ? $choice->attr : array(), $additionalAttributes);
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'option_attributes' => array(),
            )
        );
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'palogic_imagebundle_images';
    }
}