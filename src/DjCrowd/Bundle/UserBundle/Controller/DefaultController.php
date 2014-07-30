<?php

namespace DjCrowd\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DjCrowdUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
