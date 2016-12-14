<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/categories/{name}")
     */
    public function showAction($name)
    {
        $category = $this->getDoctrine()->getRepository('CoreBundle:Category')->findOneBy([
            'name' => $name
        ]);



        $jobs = $this->getDoctrine()->getRepository('CoreBundle:Job')->findBy(
            [
                'category' => $category
            ],
            [
                 'createdAt' => 'ASC'
            ]
        );

        return $this->render('CoreBundle:Category:show.html.twig', array(
            'category' => $category
        ));
    }

}
