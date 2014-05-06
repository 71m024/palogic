<?php

namespace Boxenmieten\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Boxenmieten\AppBundle\Entity\Boxe;
use Boxenmieten\AppBundle\Entity\Mixer;
use Boxenmieten\AppBundle\Entity\Cable;
use Boxenmieten\AppBundle\Entity\Stand;
use Boxenmieten\AppBundle\Entity\Mic;

class ComponentController extends Controller
{
    /**
    * @Template
    */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $components = $em->getRepository('BoxenmietenAppBundle:Component')->findAll();
        $sets = $em->getRepository('BoxenmietenAppBundle:Set')->findAll();
        
        return array('components' => $components, 'sets' => $sets);
    }
    
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $component = $em->getRepository('BoxenmietenAppBundle:Component')->find($id);
        
        if (!$component) {
            throw $this->createNotFoundException('Unable to find Component.');
        }
        
        if ($component instanceof Boxe) {
            return $this->render('BoxenmietenAppBundle:Component/Show:boxe.html.twig',
                    array('component' => $component));
        }
        
        if ($component instanceof Mixer) {
            return $this->render('BoxenmietenAppBundle:Component/Show:mixer.html.twig',
                    array('component' => $component));
        }
        
        if ($component instanceof Stand) {
            return $this->render('BoxenmietenAppBundle:Component/Show:stand.html.twig',
                    array('component' => $component));
        }
        
        if ($component instanceof Cable) {
            return $this->render('BoxenmietenAppBundle:Component/Show:cable.html.twig',
                    array('component' => $component));
        }
        
        if ($component instanceof Mic) {
            return $this->render('BoxenmietenAppBundle:Component/Show:mic.html.twig',
                    array('component' => $component));
        }
    }
}