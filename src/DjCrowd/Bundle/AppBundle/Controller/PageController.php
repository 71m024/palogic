<?php

namespace DjCrowd\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
    /**
    * @Template
    */
    public function indexAction()
    {
        return array();
    }
}