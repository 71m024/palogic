<?php

namespace Boxenmieten\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PaLogic\Bundle\AppBundle\Entity\Boxe;
use PaLogic\Bundle\AppBundle\Entity\Mixer;
use PaLogic\Bundle\AppBundle\Entity\Cable;
use PaLogic\Bundle\AppBundle\Entity\Stand;
use PaLogic\Bundle\AppBundle\Entity\Mic;

class ArticleController extends Controller
{
    /**
    * @Template
    */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        
        $articles = $em->getRepository('PaLogicAppBundle:Article')->findAll();
        
        return array('articles' => $articles);
    }
    
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();
        
        $article = $em->getRepository('PaLogicAppBundle:Article')->find($id);
        
        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article.');
        }
        
        if ($article instanceof Boxe) {
            return $this->render('BoxenmietenAppBundle:Article/Show:boxe.html.twig',
                    array('article' => $article));
        }
        
        if ($article instanceof Mixer) {
            return $this->render('BoxenmietenAppBundle:Article/Show:mixer.html.twig',
                    array('article' => $article));
        }
        
        if ($article instanceof Stand) {
            return $this->render('BoxenmietenAppBundle:Article/Show:stand.html.twig',
                    array('article' => $article));
        }
        
        if ($article instanceof Cable) {
            return $this->render('BoxenmietenAppBundle:Article/Show:cable.html.twig',
                    array('$article' => $article));
        }
        
        if ($article instanceof Mic) {
            return $this->render('BoxenmietenAppBundle:Article/Show:mic.html.twig',
                    array('article' => $article));
        }
    }
}