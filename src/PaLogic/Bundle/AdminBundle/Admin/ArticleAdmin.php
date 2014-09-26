<?php

namespace PaLogic\Bundle\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use PaLogic\Bundle\AppBundle\Entity\Boxe;
use PaLogic\Bundle\AppBundle\Entity\Stand;
use PaLogic\Bundle\AppBundle\Entity\Cable;
use PaLogic\Bundle\AppBundle\Entity\Mixer;
use PaLogic\Bundle\AppBundle\Entity\Mic;

class ArticleAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $article = $this->getSubject();
        
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
            ->add('image', 'sonata_type_model', array('required' => true, 'multiple' => false))
            ->add('images', 'sonata_type_model', array('required' => false, 'multiple' => true))
            ->add('website', 'text', array('required' => false))
        ;
        
        if ($article instanceof Boxe) {
            $formMapper
                ->with('Detail')
                ->add('assembly', 'text', array('label' => 'Bestückung'))
                ->add('kgWeight', 'integer', array('label' => 'Gewicht (kg)'))
                ->add('frequency', 'text', array('label' => 'Frequenzbereich'))
                ->add('dimensions', 'text', array('label' => 'Masse'));
        }
        
        if ($article instanceof Stand) {
            $formMapper
                ->with('Detail')
                ->add('maxHeight', 'text', array('label' => 'Maximale Höhe'))
                ->add('minHeight', 'text', array('label' => 'Minimale Höhe'))
                ->add('maxLoad', 'text', array('label' => 'Maximale Last'));
        }
        
        if ($article instanceof Cable) {
            $formMapper
                ->with('Detail')
                ->add('cmLength', 'integer', array('label' => 'Länge (cm.)'))
                ->add('type', 'text', array('label' => 'Typ'));
        }
        
        if ($article instanceof Mixer) {
            $formMapper
                ->with('Detail')
                ->add('inputs', 'text', array('label' => 'Eingänge'))
                ->add('outputs', 'text', array('label' => 'Ausgänge'))
                ->add('preamps', 'text', array('label' => 'Vorverstärker'));
        }
        
        if ($article instanceof Mic) {
            $formMapper
                ->with('Detail')
                ->add('sensitivity', 'text', array('label' => 'Empfindlichkeit'))
                ->add('directivity', 'text', array('label' => 'Richtcharakteristik'))
                ->add('transmissionRange', 'text', array('label' => 'Übertragungsbereich'))
                ->add('weight', 'text', array('label' => 'Gewicht'));
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