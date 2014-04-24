<?php

namespace Boxenmieten\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Boxenmieten\AppBundle\Entity\Image;

class ImageController extends Controller
{
    /**
    * @Template
    */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $image = $em->getRepository('BoxenmietenAppBundle:Image')->find($id);
        
        if (!$image) {
            throw $this->createNotFoundException('Unable to find this image.');
        }
        
        return array('image' => $image);
    }
}