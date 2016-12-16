<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Job;
use CoreBundle\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class JobController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        $jobs = $this->getDoctrine()->getRepository('CoreBundle:Job')->getRecentJobs();

        $jobsByCat = $this->setJobsToCategory($jobs);

        return $this->render('CoreBundle:Job:index.html.twig', array(
            'jobsByCat' => $jobsByCat
        ));
    }

    /**
     * @Route("/new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->checkAndGetUser();
            $job->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'You posted your job successfully');

            return $this->redirectToRoute('core_job_show', [
                'id' => $job->getId(),
            ]);
        }
        return $this->render(
            'CoreBundle:Job:new.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/show/{id}")
     */
    public function showAction($id)
    {
        $job = $this->getDoctrine()->getRepository('CoreBundle:Job')->find($id);

        return $this->render('CoreBundle:Job:show.html.twig', array(
            'job' => $job
        ));
    }

    /**
     * @Route("/search")
     */
    public function searchAction(Request $request)
    {
        $keywords = $request->get("keywords");

        if($keywords !== null){
            $relevantJobs = $this->getDoctrine()->getRepository('CoreBundle:Job')->searchForJob($keywords);

            $jobsByCat = $this->setJobsToCategory($relevantJobs);

            return $this->render('CoreBundle:Job:index.html.twig', array(
                'jobsByCat' => $jobsByCat
            ));
        }
    }

    /**
     * @param $jobs
     * @return array
     */
    private function setJobsToCategory($jobs)
    {
        $jobsByCat = [];

        foreach ($jobs as $job) {
            $catOfTheJob = $job->getCategory()->getName();

            if (array_key_exists($catOfTheJob, $jobsByCat)) {
                array_push($jobsByCat[$catOfTheJob], $job);
            } else {
                $jobsByCat[$catOfTheJob] = [$job];
            }

        }
        return $jobsByCat;
    }

    private function checkAndGetUser()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }


        return $this->get('security.token_storage')->getToken()->getUser();
    }

}
