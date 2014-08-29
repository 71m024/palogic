<?php

namespace PaLogic\Bundle\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class Builder
{
    private $factory;
    
    private $em;
    
    private $securityContext;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, EntityManager $em, SecurityContext $securityContext)
    {
        $this->em = $em;
        $this->factory = $factory;
        $this->securityContext = $securityContext;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        if($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
            $userMenu = $this->factory->createItem($this->securityContext->getToken()->getUsername(), array(
                'route' => 'fos_user_profile_show',
                'extras' => array(
                    'routes' => array('fos_user_security_logout')
                )));
            $userMenu->addChild("Logout", array('route' => 'fos_user_security_logout'));
            $menu->addChild($userMenu);
        }
        
        return $menu;
    }
}