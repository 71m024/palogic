<?php

namespace PaLogic\Bundle\DjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use PaLogic\Bundle\DjBundle\Entity\Genre;
use PaLogic\Bundle\DjBundle\Form\GenreType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Genre controller.
 *
 */
class GenreController extends Controller
{

    /**
     * Lists all Genre entities.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PaLogicDjBundle:Genre')->findAll();

        return $this->render('PaLogicDjBundle:Genre:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Genre entity.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function createAction(Request $request)
    {
        $entity = new Genre();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pa_logic_dj_genre_show', array('id' => $entity->getId())));
        }

        return $this->render('PaLogicDjBundle:Genre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Genre entity.
     *
     * @param Genre $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Genre $entity)
    {
        $form = $this->createForm(new GenreType(), $entity, array(
            'action' => $this->generateUrl('pa_logic_dj_genre_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Genre entity.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function newAction()
    {
        $entity = new Genre();
        $form   = $this->createCreateForm($entity);

        return $this->render('PaLogicDjBundle:Genre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Genre entity.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaLogicDjBundle:Genre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PaLogicDjBundle:Genre:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Genre entity.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaLogicDjBundle:Genre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genre entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PaLogicDjBundle:Genre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Genre entity.
    *
    * @param Genre $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Genre $entity)
    {
        $form = $this->createForm(new GenreType(), $entity, array(
            'action' => $this->generateUrl('pa_logic_dj_genre_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Genre entity.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PaLogicDjBundle:Genre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pa_logic_dj_genre_edit', array('id' => $id)));
        }

        return $this->render('PaLogicDjBundle:Genre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Genre entity.
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PaLogicDjBundle:Genre')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Genre entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pa_logic_dj_genre'));
    }

    /**
     * Creates a form to delete a Genre entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pa_logic_dj_genre_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen', 'attr' => array('class' => 'red')))
            ->getForm()
        ;
    }
    
    /**
     * Get all Genre entities.

     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getGenresAction()
    {
        $request = $this->getRequest();
        $isAjax = $request->isXmlHttpRequest();

        if ($isAjax) {
            $em = $this->getDoctrine()->getManager();

            $search = $request->query->get('term');

            /**
             * @var \PaLogic\Bundle\DjBundle\Entity\Repository\GenreRepository $repository
             */
            $repository = $em->getRepository('PaLogicDjBundle:Genre');

            $qb = $repository->createQueryBuilder('g');
            $qb->select('g.name');
            $qb->add('where', $qb->expr()->like('g.name', ':search'));
            $qb->setMaxResults(5);
            $qb->orderBy('g.name', 'ASC');
            $qb->setParameter('search', '%' . $search . '%');

            $results = $qb->getQuery()->getScalarResult();

            $json = array();
            foreach ($results as $member) {
                $json[] = $member['name'];
            };

            return new Response(json_encode($json));
        }

        return new Response('This is not ajax.', 400);
    }
}
