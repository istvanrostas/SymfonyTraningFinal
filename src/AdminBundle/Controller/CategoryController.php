<?php

namespace AdminBundle\Controller;

use CoreBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 * @Route("category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository('CoreBundle:Category')->findAll();

        return $this->render('AdminBundle:Category:index.html.twig', array(
            'cats' => $categories,
        ));
    }

    /**
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $editForm = $this->createForm('CoreBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_category_edit', array('id' => $category->getId()));
        }
        return $this->render('AdminBundle:Category:edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
        ));
    }



}
