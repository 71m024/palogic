<?php

namespace PaLogic\Bundle\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\ProfileController as FosProfileController;
use PaLogic\Bundle\DjBundle\Controller\DjController;

/**
 * Controller managing the user profile
 *
 */
class ProfileController extends FosProfileController
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        $deleteForms = array();
        foreach ($user->getDjs() as $dj) {
            $deleteForms[] = DjController::createDeleteForm($dj->getId(), $this->container)->createView();
        }
        
        return $this->container->get('templating')->renderResponse(
            'FOSUserBundle:Profile:show.html.'.$this->container->getParameter('fos_user.template.engine'),
            array(
                'user' => $user,
                'delete_forms' => $deleteForms
            )
        );
    }
}
