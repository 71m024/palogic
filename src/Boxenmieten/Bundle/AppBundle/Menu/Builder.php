<?php

namespace PaLogic\Bundle\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class Builder
{
    private $factory;
    
    private $em;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, EntityManager $em)
    {
        $this->em = $em;
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array('route' => 'PaLogic\Bundle_app_homepage'));
            $rentMenu = $this->factory->createItem('Angebote', array('route' => 'PaLogic\Bundle_app_sets'));
            $rentMenu->addChild('Komponenten', array('route' => 'PaLogic\Bundle_app_components'));
        $menu->addChild($rentMenu);
            $categoryRepository = $this->em->getRepository('PaLogic\BundleBlogBundle:Category');
            $categories = $categoryRepository->findAll();
            /*$blogMenu = $this->factory->createItem('Blog', array('route' => 'PaLogic\Bundle_blog',
                'extras' => array(
                    'routes' => array('pattern' => '/^PaLogic\Bundle_blog_/'),
            )));*/
            $blogMenu = $this->factory->createItem('Blog', array('route' => 'PaLogic\Bundle_blog',
                'extras' => array(
                    'routes' => array('PaLogic\Bundle_blog_category_page', 'PaLogic\Bundle_blog_category'),
                )));
            foreach($categories as $category) {
                $blogMenu->addChild($category->getName(), array('route' => 'PaLogic\Bundle_blog_category',
                    'routeParameters' => array('categoryId' => $category->getId(), 'categoryName' => strtolower($category->getName()))
                ));
            }
        $menu->addChild($blogMenu);
        $menu->addChild('Infos', array('route' => 'PaLogic\Bundle_app_info'));
        $menu->addChild('Über mich', array('route' => 'PaLogic\Bundle_app_me'));
        $menu->addChild('Kontakt', array('route' => 'PaLogic\Bundle_app_contact'));

        return $menu;
    }
}