<?php

namespace PaLogic\Bundle\DjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PaLogic\Bundle\DjBundle\Entity\Dj;
use PaLogic\Bundle\DjBundle\Form\DjType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Dj controller.
 *
 */
class DjController extends Controller
{

    /**
     * Lists all Dj entities.
     * 
     * @Route("/", name="pa_logic_dj")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PaLogicDjBundle:Dj')->findBy(array('approved' => true));
        $genres = $em->getRepository('PaLogicDjBundle:Genre')->findAll();

        /*
         * filter out genres without approved dj's
         */
        $filteredGenres = array();
        /* @var \PaLogic\Bundle\DjBundle\Entity\Genre $genre  */
        foreach ($genres as $genre) {
            $containsEnabledDj = false;
            /* @var \PaLogic\Bundle\DjBundle\Entity\Dj $dj */
            foreach ($genre->getDjs() as $dj) {
                if ($dj->getApproved()) {
                    $containsEnabledDj = true;
                }
            }
            if ($containsEnabledDj) {
                $filteredGenres[] = $genre;
            }
        }

        return $this->render('PaLogicDjBundle:Dj:index.html.twig', array(
            'entities' => $entities,
            'genres' => $filteredGenres
        ));
    }
    
    /**
     * Lists all Dj entities.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/admin", name="pa_logic_dj_admin")
     * @Method("GET")
     * @Template()
     */
    public function adminIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PaLogicDjBundle:Dj')->findAll();
        $updateStateForms = array();
        $deleteForms = array();
        foreach ($entities as $dj) {
            $updateStateForms[] = $this->createUpdateStateForm($dj)->createView();
            $deleteForms[] = DjController::createDeleteForm($dj->getId(), $this->container)->createView();
        }

        return array(
            'entities' => $entities,
            'update_state_forms' => $updateStateForms,
            'delete_forms' => $deleteForms
        );
    }
    
    /**
     * Creates a new Dj entity.
     * 
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     * @Route("/create", name="pa_logic_dj_create")
     * @Method("POST")
     * @Template("PaLogicDjBundle:Dj:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Dj();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setOwner($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pa_logic_dj_show', array('id' => $entity->getId(), 'slug' => $entity->getSlug())));
        }

        return $this->render('PaLogicDjBundle:Dj:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Dj entity.
     *
     * @param Dj $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Dj $entity)
    {
        $form = $this->createForm(new DjType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('pa_logic_dj_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Beantragen'));

        return $form;
    }

    /**
     * Displays a form to create a new Dj entity.
     * 
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     * @Route("/new", name="pa_logic_dj_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Dj();
        $form   = $this->createCreateForm($entity);

        $images = $this->getDoctrine()->getRepository('PaLogicImageBundle:Image')->findAll();
        
        return $this->render('PaLogicDjBundle:Dj:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'images' => $images
        ));
    }

    /**
     * Finds and displays a Dj entity.
     * 
     * @Route("/{id}/{slug}/show", name="pa_logic_dj_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaLogicDjBundle:Dj')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dj entity.');
        }

        $deleteForm = $this->createDeleteForm($id, $this->container);

        return $this->render('PaLogicDjBundle:Dj:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dj entity.
     * 
     * @Route("/{id}/edit", name="pa_logic_dj_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaLogicDjBundle:Dj')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dj entity.');
        }
        
        if (false === $this->get('security.context')->isGranted('edit', $entity)) {
            throw new AccessDeniedException('Unauthorised access!');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id, $this->container);

        return $this->render('PaLogicDjBundle:Dj:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Dj entity.
    *
    * @param Dj $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Dj $entity)
    {
        $form = $this->createForm(new DjType($entity->getOwner()), $entity, array(
            'action' => $this->generateUrl('pa_logic_dj_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Speichern'));

        return $form;
    }
    /**
     * Edits an existing Dj entity.
     *
     * @Route("/{id}", name="pa_logic_dj_update")
     * @Method("PUT")
     * @Template("PaLogicDjBundle:Dj:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaLogicDjBundle:Dj')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dj entity.');
        }
        
        if (false === $this->get('security.context')->isGranted('edit', $entity)) {
            throw new AccessDeniedException('Unauthorised access!');
        }

        $deleteForm = $this->createDeleteForm($id, $this->container);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pa_logic_dj_edit', array('id' => $id)));
        }

        return $this->render('PaLogicDjBundle:Dj:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Dj entity.
     *
     * @Route("/{id}", name="pa_logic_dj_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id, $this);
        $form->handleRequest($request);

        $securityContext = $this->get('security.context');
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PaLogicDjBundle:Dj')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dj entity.');
            }
            
            if (false === $securityContext->isGranted('edit', $entity)) {
                throw new AccessDeniedException('Unauthorised access!');
            }

            $em->remove($entity);
            $em->flush();
        }
        
        $route = 'fos_user_profile_show';
        if ($securityContext->isGranted('ROLE_ADMIN')) {
            $route = 'pa_logic_dj_admin';
        }
        return $this->redirect($this->generateUrl($route));
    }

    /**
     * Creates a form to delete a Dj entity by id.
     *
     * @param mixed $id The entity id
     * @param \Symfony\Component\DependencyInjection\Container $container
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public static function createDeleteForm($id, $container)
    {
        return $container->get('form.factory')->createBuilder('form', null, array())
            ->setAction($container->get('router')->generate('pa_logic_dj_delete', array('id' => $id), UrlGeneratorInterface::ABSOLUTE_PATH))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen', 'attr' => array('class' => 'red')))
            ->getForm()
        ;
    }
    
    /**
     * Create a form to change the state of a Dj by id.
     * 
     * @param \PaLogic\Bundle\DjBundle\Entity\Dj $dj The dj
     * 
     * @return \Symfony\Component\Form\Form The form
     */
    private function createUpdateStateForm($dj)
    {
        $formBuilder = $this->createFormBuilder()
            ->setAction($this->generateUrl('pa_logic_dj_state', array('id' => $dj->getId(), 'approve' => ($dj->getApproved())?'disable':'approve')))
            ->setMethod('PUT');
        
        if ($dj->getApproved()) {
            $formBuilder->add('submit', 'submit', array('label' => 'Sperren', 'attr' => array('class' => 'red')));
        } else {
            $formBuilder->add('submit', 'submit', array('label' => 'Genehmigen', 'attr' => array('class' => 'green')));
        }
        return $formBuilder->getForm();
    }
    /**
     * Updates the status of a dj entity.
     *
     * @Route("/status/{id}/{approve}", name="pa_logic_dj_state")
     * @Method("PUT")
     */
    public function updateStatusAction(Request $request, $id, $approve)
    {
        $em = $this->getDoctrine()->getManager();
        
        /* @var $dj \PaLogic\Bundle\DjBundle\Entity\Dj */
        $dj = $em->getRepository('PaLogicDjBundle:Dj')->find($id);
        
        if (!$dj) {
            throw $this->createNotFoundException('Unable to find Dj entity.');
        }
        
        if (false === $this->get('security.context')->isGranted('edit', $dj)) {
            throw new AccessDeniedException('Unauthorised access!');
        }
        
        $form = $this->createUpdateStateForm($dj);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $dj->setApproved($approve=='approve');
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pa_logic_dj_admin'));
    }
}
