<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class InformationController extends Controller
{


    public function indexAction($position)
    {
        $infos = $this->getDoctrine()->getRepository('CoreBundle:Information')->findBy([
            'positionOnFrontend' => $position
        ]);

        $temp = $position === "h" ? 'CoreBundle:Information:header.html.twig'
            :'CoreBundle:Information:footer.html.twig';

        return $this->render($temp, array(
            'infos' => $infos
        ));
    }

    /**
     * @Route("info/show/{id}")
     */
    public function showAction($id)
    {
        $info = $this->getDoctrine()->getRepository('CoreBundle:Information')->find($id);

        return $this->render('CoreBundle:Information:show.html.twig', array(
            'info' => $info
        ));
    }

}
