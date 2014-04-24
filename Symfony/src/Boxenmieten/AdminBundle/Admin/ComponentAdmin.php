<?php

namespace Boxenmieten\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Boxenmieten\AppBundle\Entity\Boxe;
use Boxenmieten\AppBundle\Entity\Stand;
use Boxenmieten\AppBundle\Entity\Cable;
use Boxenmieten\AppBundle\Entity\Mixer;

class ComponentAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $component = $this->getSubject();
        
        $formMapper
            ->with('General')
            ->add('make', 'text', array('label' => 'Marke'))
            ->add('manufacturer', 'text', array('label' => 'Hersteller'))
            ->add('model', 'text', array('label' => 'Modell'))
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
            ->add('price', 'integer', array('label' => 'Preis'))
            ->add('weekPrice', 'integer', array('label' => 'Wochen-Preis'))
            ->add('previewImage', 'sonata_type_model', array('required' => true, 'multiple' => false))
            ->add('images', 'sonata_type_model', array('required' => false, 'multiple' => true))
            ->add('website', 'text', array('required' => false))
        ;
        
        if ($component instanceof Boxe) {
            $formMapper
                ->with('Detail')
                ->add('assembly', 'text', array('label' => 'Bestückung'))
                ->add('kgWeight', 'integer', array('label' => 'Gewicht (kg)'))
                ->add('frequency', 'text', array('label' => 'Frequenzbereich'))
                ->add('dimensions', 'text', array('label' => 'Masse'));
        }
        
        if ($component instanceof Stand) {
            $formMapper
                ->with('Detail')
                ->add('maxHeight', 'text', array('label' => 'Maximale Höhe'))
                ->add('minHeight', 'text', array('label' => 'Minimale Höhe'))
                ->add('maxLoad', 'text', array('label' => 'Maximale Last'));
        }
        
        if ($component instanceof Cable) {
            $formMapper
                ->with('Detail')
                ->add('cmLength', 'integer', array('label' => 'Länge (cm.)'))
                ->add('type', 'text', array('label' => 'Typ'));
        }
        
        if ($component instanceof Mixer) {
            $formMapper
                ->with('Detail')
                ->add('inputs', 'text', array('label' => 'Eingänge'))
                ->add('outputs', 'text', array('label' => 'Ausgänge'))
                ->add('preamps', 'text', array('label' => 'Vorverstärker'));
        }
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('make')
            ->add('manufacturer')
            ->add('model')
            ->add('price')
            ->add('weekPrice')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('model')
            ->add('make')
            ->add('manufacturer')
            ->add('price')
            ->add('weekPrice')
        ;
    }
}