<?php

namespace PaLogic\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PaLogic\Bundle\BlogBundle\Util\Paginator;

class TagController extends Controller{
    
    /**
     * Show posts of a tag
     * @Template
     */
    public function showAction($tagId, $tag, $currentPage = null)
    {
        $em = $this->getDoctrine()->getManager();
        
        $postRepository = $em->getRepository("PaLogicBlogBundle:Post");

        $limit = 3;
        $midrange = 5;

        $paginator = new Paginator($postRepository->getNumPostsForTag($tagId), $currentPage , $limit, $midrange);
        
        $posts = $postRepository->getPostsForTag($tagId, $limit, $paginator->getOffset());
        $tag = $postRepository = $em->getRepository("PaLogicBlogBundle:Tag")->find($tagId);
        
        return array('tag' => $tag,  'posts' => $posts, 'paginator' => $paginator);
    }
    
}
