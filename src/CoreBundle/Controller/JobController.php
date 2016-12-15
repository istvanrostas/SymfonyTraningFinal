<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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

}
