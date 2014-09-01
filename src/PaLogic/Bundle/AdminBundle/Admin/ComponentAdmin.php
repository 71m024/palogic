<?php

namespace PaLogic\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ComponentAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $component = $this->getSubject();
        
        $formMapper
            ->with('General')
            ->add('name', 'text', array('label' => 'Name'))
            ->add(
                'description',
                'sonata_formatter_type',
                array(
                    'label' => 'Beschreibung',
                    'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                    'format_field' => 'descriptionFormatter',
                    'source_field' => 'rawDescription',
                    'source_field_options' => array(
                        'attr' => array('class' => 'span10', 'rows' => 20)
                    ),
                    'target_field' => 'description',
                    'listener' => true,
                    'error_bubbling' => false
                )
            )
            ->add('image', 'sonata_type_model', array('required' => true, 'multiple' => false))
            ->add('possibleArticles', 'sonata_type_model', array('required' => false, 'multiple' => true))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
        ;
    }
}