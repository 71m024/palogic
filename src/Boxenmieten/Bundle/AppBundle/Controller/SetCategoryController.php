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

        $setCategories = $em->getRepository('PaLogicAppBundle:SetCategory')->findBy(array(), array("orderNumber" => "ASC"));

        return array('setCategories' => $setCategories);
    }

    /**
     * @Template
     */
    public function showAction($id, $slug) {
        $em = $this->getDoctrine()->getManager();

        $set = $em->getRepository('PaLogicAppBundle:SetCategory')->find($id);

        if (!$set) {
            throw $this->createNotFoundException('Unable to find SetCategory.');
        }

        return array('setCategory' => $set);
    }
}