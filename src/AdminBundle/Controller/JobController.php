<?php

namespace AdminBundle\Controller;

use CoreBundle\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("jobs")
 */
class JobController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $jobs = $this->getDoctrine()->getRepository('CoreBundle:Job')->findAll();

        return $this->render('AdminBundle:Job:index.html.twig', array(
            'jobs' => $jobs,
        ));
    }

    /**
     *
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);
        $editForm = $this->createForm('CoreBundle\Form\JobType', $job);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_job_edit', array('id' => $job->getId()));
        }
        return $this->render('AdminBundle:Job:edit.html.twig', array(
            'job' => $job,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Job $job)
    {
        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush($job);
        }
        return $this->redirectToRoute('admin_job_index');
    }

    /**
     * @param Job $job
     * @return mixed
     */
    private function createDeleteForm(Job $job)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_job_delete', array('id' => $job->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

}
