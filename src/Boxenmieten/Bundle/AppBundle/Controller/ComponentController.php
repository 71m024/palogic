<?php

namespace Boxenmieten\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ComponentController extends Controller
{
    /**
    * @Template
    */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $component = $em->getRepository('PaLogicAppBundle:Component')->find($id);
        
        if (!$component) {
            throw $this->createNotFoundException('Unable to find Component.');
        }
        
        return array('component' => $component);
    }
}