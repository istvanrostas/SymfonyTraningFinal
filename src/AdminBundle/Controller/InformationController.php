<?php

namespace AdminBundle\Controller;

use CoreBundle\Entity\Information;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("infos")
 */
class InformationController extends Controller
{

    /**
     * @Route("/")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $infos = $em->getRepository('CoreBundle:Information')->findAll();
        return $this->render('AdminBundle:Information:index.html.twig', array(
            'infos' => $infos,
        ));
    }
    /**
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $info = new Information();
        $form = $this->createForm('CoreBundle\Form\InformationType', $info);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($info);
            $em->flush($info);
            return $this->redirectToRoute('admin_information_index', array('id' => $info->getId()));
        }
        return $this->render('AdminBundle:Information:new.html.twig', array(
            'info' => $info,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Information $info){
        $deleteForm = $this->createDeleteForm($info);
        $editForm = $this->createForm('CoreBundle\Form\InformationType', $info);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_information_edit', array('id' => $info->getId()));
        }
        return $this->render('AdminBundle:Information:edit.html.twig', array(
            'info' => $info,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     *
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Information $info)
    {
        $form = $this->createDeleteForm($info);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($info);
            $em->flush($info);
        }
        return $this->redirectToRoute('admin_information_index');
    }

    /**
     * @param Information $info
     * @return mixed
     */
    private function createDeleteForm(Information $info)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_information_delete', array('id' => $info->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

}
