<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class JobController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        $jobs = $this->getDoctrine()->getRepository('CoreBundle:Job')->getRecentJobs();

        $jobsByCat = [];
        foreach ($jobs as $job){
            if(array_key_exists($job->getCategory()->getName(),$jobsByCat)){
                array_push($jobsByCat[$job->getCategory()->getName()], $jobs);
            }else{
                $jobsByCat[$job->getCategory()->getName()] = [$jobs];
            }

        }

        return $this->render('CoreBundle:Job:index.html.twig', array(
            'jobsByCat' => $jobsByCat
        ));
    }



}
