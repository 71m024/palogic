<?php

namespace PaLogic\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ImageController extends Controller
{
    /**
    * @Template
    */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $image = $em->getRepository('PaLogicAppBundle:Image')->find($id);
        
        if (!$image) {
            throw $this->createNotFoundException('Unable to find this image.');
        }
        
        return array('image' => $image);
    }
}