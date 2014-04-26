<?php

namespace Boxenmieten\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Boxenmieten\BlogBundle\Entity\Post;
use Boxenmieten\BlogBundle\Util\Paginator;

class BlogController extends Controller {
    
    /**
     * Show blog-index
     * 
     * @param Integer $currentPage Which site
     * @Template
     */
    public function indexAction($currentPage = null) {
        $em = $this->getDoctrine()->getManager();
        
        $repository = $em->getRepository("BoxenmietenBlogBundle:Post");

        $limit = 3;
        $midrange = 5;

        $paginator = new Paginator($repository->getNumPosts(), $currentPage , $limit, $midrange);
        
        $posts = $repository->getPosts($limit, $paginator->getOffset());
        
        return array('posts' => $posts, 'paginator' => $paginator);
    }
    
    
    /**
     * Show a blog entry
     * @Template
     */
    public function showAction($id, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BoxenmietenBlogBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $comments = $em->getRepository('BoxenmietenBlogBundle:Comment')
                       ->getCommentsForPost($post->getId());

        return array(   'post'      => $post,
                        'comments'  => $comments);
    }
    
    /**
     * @Template
     */
    public function sidebarAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $categories = $em->getRepository('BoxenmietenBlogBundle:Category')
                        ->findAll();
        $tags = $em->getRepository('BoxenmietenBlogBundle:Tag')
                        ->findAll(); 

        return array(
            'categories'  => $categories,
            'tags' => $tags
        );
    }
}
