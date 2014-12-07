<?php

namespace PaLogic\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SetAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        
        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('summary', 'text', array('label' => 'kurze Beschreibung'))
            ->add('orderNumber')
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
            ->add('weekPrice', 'integer', array('label' => 'Wochen-Preis'))
            ->add('components', 'sonata_type_collection',
                array(
                    'required' => false,
                    'by_reference' => false,
                    'label' => 'Komponenten'
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'allow_delete' => true
                )
            )
            ->add('previewImage', 'sonata_type_model', array('required' => true, 'multiple' => false))
            ->add('images', 'sonata_type_model', array('required' => false, 'multiple' => true))
            ->add('categories', 'sonata_type_model', array('required' => false, 'multiple' => true))
            ->add('previewOnStart')
            ->add('locales')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('weekPrice')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('weekPrice')
        ;
    }
    
    public function prePersist($set)
    {
        foreach ($set->getComponents() as $rule) {
            $rule->setSet($set);
        }
    }

    public function preUpdate($set)
    {
        foreach ($set->getComponents() as $rule) {
            $rule->setSet($set);
        }
        $set->setComponents($set->getComponents());
    }
}