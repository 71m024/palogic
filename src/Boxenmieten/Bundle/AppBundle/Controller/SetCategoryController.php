<?php

namespace Boxenmieten\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \PaLogic\Bundle\AppBundle\Entity\SetCategory;

class SetCategoryController extends Controller
{
    /**
     * @Template
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $setCategories = $em->getRepository('PaLogicAppBundle:SetCategory')->getSetCategories();

        return array('setCategories' => $setCategories);
    }

    /**
     * @Template
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $setCategory = $em->getRepository('PaLogicAppBundle:SetCategory')->findSetCategoryById($id);

        if (!$setCategory) {
            throw $this->createNotFoundException('Unable to find SetCategory.');
        }

        return array('setCategory' => $setCategory);
    }
}