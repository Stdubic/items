<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Salesrep;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Salesrep controller.
 *
 * @Route("salesrep")
 */
class SalesrepController extends Controller
{
    /**
     * Lists all salesrep entities.
     *
     * @Route("/", name="salesrep_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $salesreps = $em->getRepository('AppBundle:Salesrep')->findAll();

        return $this->render('salesrep/index.html.twig', array(
            'salesreps' => $salesreps,
        ));
    }

    /**
     * Creates a new salesrep entity.
     *
     * @Route("/new", name="salesrep_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $salesrep = new Salesrep();
        $form = $this->createForm('AppBundle\Form\SalesrepType', $salesrep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salesrep);
            $em->flush($salesrep);

            return $this->redirectToRoute('salesrep_show', array('id' => $salesrep->getId()));
        }

        return $this->render('salesrep/new.html.twig', array(
            'salesrep' => $salesrep,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a salesrep entity.
     *
     * @Route("/{id}", name="salesrep_show")
     * @Method("GET")
     */
    public function showAction(Salesrep $salesrep)
    {
        $deleteForm = $this->createDeleteForm($salesrep);

        return $this->render('salesrep/show.html.twig', array(
            'salesrep' => $salesrep,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing salesrep entity.
     *
     * @Route("/{id}/edit", name="salesrep_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Salesrep $salesrep)
    {
        $deleteForm = $this->createDeleteForm($salesrep);
        $editForm = $this->createForm('AppBundle\Form\SalesrepType', $salesrep);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salesrep_edit', array('id' => $salesrep->getId()));
        }

        return $this->render('salesrep/edit.html.twig', array(
            'salesrep' => $salesrep,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a salesrep entity.
     *
     * @Route("/{id}", name="salesrep_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Salesrep $salesrep)
    {
        $form = $this->createDeleteForm($salesrep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($salesrep);
            $em->flush($salesrep);
        }

        return $this->redirectToRoute('salesrep_index');
    }

    /**
     * Creates a form to delete a salesrep entity.
     *
     * @param Salesrep $salesrep The salesrep entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Salesrep $salesrep)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salesrep_delete', array('id' => $salesrep->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
