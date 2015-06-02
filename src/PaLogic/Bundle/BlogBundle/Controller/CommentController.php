<?php

namespace PaLogic\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PaLogic\Bundle\BlogBundle\Entity\Comment;
use PaLogic\Bundle\BlogBundle\Form\CommentType;

/**
 * Description of CommentController
 *
 * @author Timo
 */
class CommentController extends Controller {
    
    /**
     * @Template
     */
    public function indexAction() {
        
        $em = $this->getDoctrine()->getManager();
        
        $posts = $em->getRepository("PaLogicBlogBundle:Post")
                    ->getLatestPosts();
        
        return array('posts' => $posts);
    }

    public function newAction($post_id)
    {
        $post = $this->getPost($post_id);

        $comment = new Comment();
        $comment->setPost($post);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('PaLogicBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }

    public function createAction($post_id)
    {
        $post = $this->getPost($post_id);

        $comment  = new Comment();
        $comment->setPost($post);
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('palogic_blog_show', array(
                'id' => $comment->getPost()->getId(),
                'slug'  => $comment->getPost()->getSlug())) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('PaLogicBlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }
    
    protected function getPost($post_id)
    {
        $em = $this->getDoctrine()
                    ->getManager();

        $post = $em->getRepository('PaLogicBlogBundle:Post')->find($post_id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $post;
    }
    
}
