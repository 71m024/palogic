<?php

namespace Boxenmieten\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SetController extends Controller
{
    /**
    * @Template
    */
    public function indexAction() {
        
        $em = $this->getDoctrine()->getManager();
        
        $sets = $em->getRepository('BoxenmietenAppBundle:Set')->findBy(array(), array("weekPrice" => "ASC"));
        
        return array('sets' => $sets);
    }
    
    /**
     * @Template
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $set = $em->getRepository('BoxenmietenAppBundle:Set')->find($id);
        
        if (!$set) {
            throw $this->createNotFoundException('Unable to find Component.');
        }
        
        return array('set' => $set);
    }
}