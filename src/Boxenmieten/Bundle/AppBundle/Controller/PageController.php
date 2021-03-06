<?php

namespace Boxenmieten\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Boxenmieten\Bundle\AppBundle\Entity\Question;
use Boxenmieten\Bundle\AppBundle\Form\QuestionType;

class PageController extends Controller
{
    /**
    * @Template
    */
    public function indexAction()
    {
        $setRepository = $this->getDoctrine()->getRepository('PaLogicAppBundle:Set');
        $sets = $setRepository->findBy(array('previewOnStart' => true));

        return array('sets' => $sets);
    }
    
    /**
    * @Template
    */
    public function aboutAction()
    {
        return array();
    }
    
    /**
    * @Template
    */
    public function teamAction()
    {
        return array();
    }
    
    /**
    * @Template
    */
    public function infoAction()
    {
        return array();
    }

    /**
     * @Template
     */
    public function localesAction()
    {
        return array();
    }
    
    /**
    * @Template
    */
    public function offersAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sets = $em->getRepository('PaLogicAppBundle:Set')->findAll();
        
        return array('sets' => $sets);
    }

    /**
     * @Template
     */
    public function referencesAction()
    {
        return array();
    }
    
    /**
    * @Template
    */
    public function contactAction()
    {
        $question = new Question();
        $form = $this->createForm(new QuestionType(), $question);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $message = \Swift_Message::newInstance()
                    ->setSubject('Frage von: ' . $question->getName())
                    ->setFrom('bot@boxenmieten.ch')
                    ->setTo($this->container->getParameter('boxenmieten_app.emails.contact_email'))
                    ->setBody($this->renderView('BoxenmietenAppBundle:Page:contactEmail.txt.twig', array('question' => $question)));
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->set('question-notice', 'Deine Anfrage wurde entgegengenommen. Wir nehmen so schnell wie möglich mit dir Kontakt auf!');

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('boxenmieten_app_contact') . "#frageGestellt");
            }
        }

        return array('form' => $form->createView());
    }
}