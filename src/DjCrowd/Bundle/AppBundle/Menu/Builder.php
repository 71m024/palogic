<?php

namespace DjCrowd\Bundle\AppBundle\Menu;

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

        $menu->addChild('Home', array('route' => 'djcrowd_app_homepage'));
            $blogMenu = $this->factory->createItem('Blog', array('route' => 'dj_crowd_palogic_blog',
                'extras' => array(
                    'routes' => array('dj_crowd_palogic_blog_category_page', 'dj_crowd_palogic_blog_category'),
                )));
            $categoryRepository = $this->em->getRepository('PaLogicBlogBundle:Category');
            $categories = $categoryRepository->findAll();
            foreach($categories as $category) {
                $blogMenu->addChild($category->getName(), array('route' => 'dj_crowd_palogic_blog_category',
                    'routeParameters' => array('categoryId' => $category->getId(), 'categoryName' => strtolower($category->getName()))
                ));
            }
        $menu->addChild($blogMenu);
        if($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
            $userMenu = $this->factory->createItem($this->securityContext->getToken()->getUsername(), array(
                'route' => 'djcrowd_fos_user_profile_show',
                'extras' => array(
                    'routes' => array('djcrowd_fos_user_security_logout')
                )));
            $userMenu->addChild("Logout", array('route' => 'fos_user_security_logout'));
            $menu->addChild($userMenu);
        }
        
        return $menu;
    }
}