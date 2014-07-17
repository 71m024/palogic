<?php

namespace DjCrowd\Bundle\AppBundle\Menu;

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

        $menu->addChild('Home', array('route' => 'djcrowd_app_homepage'));
            $blogMenu = $this->factory->createItem('Blog', array('route' => 'djcrowd_palogic_blog',
                'extras' => array(
                    'routes' => array('djcrowd_palogic_blog_category_page', 'djcrowd_palogic_blog_category'),
                )));
            $categoryRepository = $this->em->getRepository('PaLogicBlogBundle:Category');
            $categories = $categoryRepository->findAll();
            foreach($categories as $category) {
                $blogMenu->addChild($category->getName(), array('route' => 'djcrowd_palogic_blog_category',
                    'routeParameters' => array('categoryId' => $category->getId(), 'categoryName' => strtolower($category->getName()))
                ));
            }
        $menu->addChild($blogMenu);

        return $menu;
    }
}