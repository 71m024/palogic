<?php

namespace Boxenmieten\Bundle\AppBundle\Menu;

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

        $menu->addChild('Home', array('route' => 'boxenmieten_app_homepage'));
            $rentMenu = $this->factory->createItem('Angebote', array('route' => 'boxenmieten_app_sets'));
            $rentMenu->addChild('Komponenten', array('route' => 'boxenmieten_app_articles'));
        $menu->addChild($rentMenu);
            $categoryRepository = $this->em->getRepository('PaLogicBlogBundle:Category');
            $categories = $categoryRepository->findAll();
            /*$blogMenu = $this->factory->createItem('Blog', array('route' => 'boxenmieten_blog',
                'extras' => array(
                    'routes' => array('pattern' => '/^boxenmieten_blog_/'),
            )));*/
            $blogMenu = $this->factory->createItem('Blog', array('route' => 'boxenmieten_palogic_blog',
                'extras' => array(
                    'routes' => array('boxenmieten_palogic_blog_category_page', 'boxenmieten_palogic_blog_category'),
                )));
            foreach($categories as $category) {
                $blogMenu->addChild($category->getName(), array('route' => 'boxenmieten_palogic_blog_category',
                    'routeParameters' => array('categoryId' => $category->getId(), 'categoryName' => strtolower($category->getName()))
                ));
            }
        $menu->addChild($blogMenu);
        $menu->addChild('Infos', array('route' => 'boxenmieten_app_info'));
        $menu->addChild('Über mich', array('route' => 'boxenmieten_app_me'));
        $menu->addChild('Kontakt', array('route' => 'boxenmieten_app_contact'));

        return $menu;
    }
}