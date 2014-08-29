<?php

namespace DjCrowd\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class PageController extends Controller
{
    /**
     * Homepage
     * 
     * @Route("/", name="djcrowd_app_homepage")
     * @Method("GET")
     * @Template
     */
    public function indexAction()
    {
        /* copied from PaLogicDjBundle:DjController */
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PaLogicDjBundle:Dj')->findBy(array('approved' => true));
        $genres = $em->getRepository('PaLogicDjBundle:Genre')->findAll();

        return array(
            'djs' => $entities,
            'genres' => $genres
        );
        /* endcopied */
    }
    
    /**
     * Page for DJ's
     * 
     * @Route("/fordjs", name="djcrowd_app_fordjs")
     * @Method("GET")
     * @Template
     */
    public function forDjsAction(Request $request)
    {        
        return array();
    }
}