<?php

namespace PaLogic\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SetComponentAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('num', 'integer', array('label' => 'Anzahl'))
            /*->add('set', 'sonata_type_model', array('required' => true, 'multiple' => false))*/
            ->add('component', 'sonata_type_model', array('required' => true, 'multiple' => false))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('component')
            ->add('set')
            ->add('num')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('component')
            ->add('set')
            ->add('num')
        ;
    }
}