<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Oninvoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Oninvoice controller.
 *
 * @Route("oninvoice")
 */
class OninvoiceController extends Controller
{
    /**
     * Lists all oninvoice entities.
     *
     * @Route("/", name="oninvoice_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $oninvoices = $em->getRepository('AppBundle:Oninvoice')->findAll();

        return $this->render('oninvoice/index.html.twig', array(
            'oninvoices' => $oninvoices,
        ));
    }

    /**
     * Creates a new oninvoice entity.
     *
     * @Route("/new", name="oninvoice_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $oninvoice = new Oninvoice();
        $form = $this->createForm('AppBundle\Form\OninvoiceType', $oninvoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oninvoice);
            $em->flush($oninvoice);

            return $this->redirectToRoute('oninvoice_show', array('id' => $oninvoice->getId()));
        }

        return $this->render('oninvoice/new.html.twig', array(
            'oninvoice' => $oninvoice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a oninvoice entity.
     *
     * @Route("/{id}", name="oninvoice_show")
     * @Method("GET")
     */
    public function showAction(Oninvoice $oninvoice)
    {
        $deleteForm = $this->createDeleteForm($oninvoice);

        return $this->render('oninvoice/show.html.twig', array(
            'oninvoice' => $oninvoice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing oninvoice entity.
     *
     * @Route("/{id}/edit", name="oninvoice_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Oninvoice $oninvoice)
    {
        $deleteForm = $this->createDeleteForm($oninvoice);
        $editForm = $this->createForm('AppBundle\Form\OninvoiceType', $oninvoice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('oninvoice_edit', array('id' => $oninvoice->getId()));
        }

        return $this->render('oninvoice/edit.html.twig', array(
            'oninvoice' => $oninvoice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a oninvoice entity.
     *
     * @Route("/{id}", name="oninvoice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Oninvoice $oninvoice)
    {
        $form = $this->createDeleteForm($oninvoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oninvoice);
            $em->flush($oninvoice);
        }

        return $this->redirectToRoute('oninvoice_index');
    }

    /**
     * Creates a form to delete a oninvoice entity.
     *
     * @param Oninvoice $oninvoice The oninvoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Oninvoice $oninvoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oninvoice_delete', array('id' => $oninvoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
