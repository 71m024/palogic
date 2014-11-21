<?php

namespace PaLogic\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Post Title'))
            ->add('author', 'text', array('label' => 'Post Author'))
            ->add('headline', 'text')
            ->add(
                'text',
                'sonata_formatter_type',
                array(
                    'label' => 'Text',
                    'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                    'format_field' => 'textFormatter',
                    'source_field' => 'rawText',
                    'source_field_options' => array(
                        'attr' => array('class' => 'span10', 'rows' => 20)
                    ),
                    'target_field' => 'text',
                    'listener' => true,
                    'error_bubbling' => false
                )
            )
            ->add('image', 'sonata_type_model', array('required' => false))
            ->add('tags', 'sonata_type_model', array('multiple' => true))
            ->add('categories', 'sonata_type_model', array('multiple' => true))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('author')
            ->add('text')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('slug')
            ->add('author')
        ;
    }
}