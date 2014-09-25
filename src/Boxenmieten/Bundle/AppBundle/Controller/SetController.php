<?php

namespace Boxenmieten\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \PaLogic\Bundle\AppBundle\Entity\SetCategory;

class SetController extends Controller
{
    /**
     * @Template
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $set = $em->getRepository('PaLogicAppBundle:Set')->find($id);
        
        if (!$set) {
            throw $this->createNotFoundException('Unable to find Component.');
        }
        
        return array('set' => $set);
    }
}