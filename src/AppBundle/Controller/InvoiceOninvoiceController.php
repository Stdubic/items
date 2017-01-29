<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Invoice;
use AppBundle\Entity\Oninvoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * InvoiceOninvoiceController controller.
 *
 * @Route("ioi")
 */
class InvoiceOninvoiceController extends Controller
{


    /**
     * Creates a new invoice entity.
     *
     * @Route("/new", name="ioi_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $invoice = new Invoice();
        $form = $this->createForm('AppBundle\Form\InvoiceType', $invoice);
        $form->handleRequest($request);

        $oninvoice = new Oninvoice();
        $formOninvoice = $this->createForm('AppBundle\Form\OninvoiceType', $oninvoice);
        $formOninvoice->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush($invoice);

            return $this->redirectToRoute('ioi_new');
        }





        if ($formOninvoice->isSubmitted() && $formOninvoice->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oninvoice);
            $em->flush($oninvoice);

            return $this->redirectToRoute('oninvoice_show', array('id' => $oninvoice->getId()));
        }

        return $this->render('ioi/new.html.twig', array(
            'oninvoice' => $oninvoice,
            'form' => $form->createView(),
            'formOninvoice' => $formOninvoice->createView(),
        ));
    }

}
