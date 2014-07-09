<?php

namespace Boxenmieten\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Boxenmieten\BlogBundle\Util\Paginator;

class CategoryController extends Controller{
    
    /**
     * Show posts of a category
     * @Template
     */
    public function showAction($categoryId, $categoryName, $currentPage = null)
    {
        $em = $this->getDoctrine()->getManager();
        
        $postRepository = $em->getRepository("BoxenmietenBlogBundle:Post");

        $limit = 3;
        $midrange = 5;

        $paginator = new Paginator($postRepository->getNumPostsForCategory($categoryId), $currentPage , $limit, $midrange);
        
        $posts = $postRepository->getPostsForCategory($categoryId, $limit, $paginator->getOffset());
        $category = $postRepository = $em->getRepository("BoxenmietenBlogBundle:Category")->find($categoryId);
        
        return array('category' => $category,  'posts' => $posts, 'paginator' => $paginator);
    }
    
}
