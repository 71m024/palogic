<?php

namespace PaLogic\Bundle\DjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PaLogic\Bundle\DjBundle\Entity\Dj;
use PaLogic\Bundle\DjBundle\Form\DjType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Dj controller.
 *
 */
class DjController extends Controller
{

    /**
     * Lists all Dj entities.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     * 
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PaLogicDjBundle:Dj')->findAll();
        $genres = $em->getRepository('PaLogicDjBundle:Genre')->findAll();

        return $this->render('PaLogicDjBundle:Dj:index.html.twig', array(
            'entities' => $entities,
            'genres' => $genres
        ));
    }
    /**
     * Creates a new Dj entity.
     * 
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     *
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

            return $this->redirect($this->generateUrl('pa_logic_dj_show', array('id' => $entity->getId())));
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
     *
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
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaLogicDjBundle:Dj')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dj entity.');
        }
        
        if (false === $this->get('security.context')->isGranted('view', $entity)) {
            throw new AccessDeniedException('Unauthorised access!');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PaLogicDjBundle:Dj:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dj entity.
     * 
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
        $deleteForm = $this->createDeleteForm($id);

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
        $form = $this->createForm(new DjType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('pa_logic_dj_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Speichern'));

        return $form;
    }
    /**
     * Edits an existing Dj entity.
     *
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

        $deleteForm = $this->createDeleteForm($id);
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
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PaLogicDjBundle:Dj')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dj entity.');
            }
            
            if (false === $this->get('security.context')->isGranted('edit', $entity)) {
                throw new AccessDeniedException('Unauthorised access!');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pa_logic_dj'));
    }

    /**
     * Creates a form to delete a Dj entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pa_logic_dj_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen', 'attr' => array('class' => 'red')))
            ->getForm()
        ;
    }
}
