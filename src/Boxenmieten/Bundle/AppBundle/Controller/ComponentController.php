<?php

namespace PaLogic\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PaLogic\Bundle\AppBundle\Entity\Boxe;
use PaLogic\Bundle\AppBundle\Entity\Mixer;
use PaLogic\Bundle\AppBundle\Entity\Cable;
use PaLogic\Bundle\AppBundle\Entity\Stand;
use PaLogic\Bundle\AppBundle\Entity\Mic;

class ComponentController extends Controller
{
    /**
    * @Template
    */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $components = $em->getRepository('PaLogic\BundleAppBundle:Component')->findAll();
        $sets = $em->getRepository('PaLogic\BundleAppBundle:Set')->findAll();
        
        return array('components' => $components, 'sets' => $sets);
    }
    
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $component = $em->getRepository('PaLogic\BundleAppBundle:Component')->find($id);
        
        if (!$component) {
            throw $this->createNotFoundException('Unable to find Component.');
        }
        
        if ($component instanceof Boxe) {
            return $this->render('PaLogic\BundleAppBundle:Component/Show:boxe.html.twig',
                    array('component' => $component));
        }
        
        if ($component instanceof Mixer) {
            return $this->render('PaLogic\BundleAppBundle:Component/Show:mixer.html.twig',
                    array('component' => $component));
        }
        
        if ($component instanceof Stand) {
            return $this->render('PaLogic\BundleAppBundle:Component/Show:stand.html.twig',
                    array('component' => $component));
        }
        
        if ($component instanceof Cable) {
            return $this->render('PaLogic\BundleAppBundle:Component/Show:cable.html.twig',
                    array('component' => $component));
        }
        
        if ($component instanceof Mic) {
            return $this->render('PaLogic\BundleAppBundle:Component/Show:mic.html.twig',
                    array('component' => $component));
        }
    }
}