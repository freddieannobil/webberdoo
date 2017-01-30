<?php

namespace Webberdoo\AppBundle\Controllers\Admin;

use Webberdoo\AppBundle\Entity\Widget;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Widget controller.
 *@Security("is_granted('ROLE_ADMIN')")
 * @Route("admin/widget")
 */
class WidgetController extends Controller
{
    /**
     * Lists all widget entities.
     *
     * @Route("/", name="admin_widget_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $widgets = $em->getRepository('AppBundle:Widget')->findAll();

        return $this->render($this->getParameter('theme_name').'/admin/widget/index.html.twig', array(
            'widgets' => $widgets,
        ));
    }

    /**
     * Creates a new widget entity.
     *
     * @Route("/new", name="admin_widget_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $widget = new Widget();
        $form = $this->createForm('AppBundle\Form\WidgetType', $widget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($widget);
            $em->flush($widget);

            return $this->redirectToRoute('admin_widget_index');
        }

        return $this->render($this->getParameter('theme_name').'/admin/widget/new.html.twig', array(
            'widget' => $widget,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a widget entity.
     *
     * @Route("/{id}", name="admin_widget_show")
     * @Method("GET")
     */
    public function showAction(Widget $widget)
    {
        $deleteForm = $this->createDeleteForm($widget);

        return $this->render($this->getParameter('theme_name').'/admin/widget/show.html.twig', array(
            'widget' => $widget,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing widget entity.
     *
     * @Route("/{id}/edit", name="admin_widget_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Widget $widget)
    {
        $deleteForm = $this->createDeleteForm($widget);
        $editForm = $this->createForm('AppBundle\Form\WidgetType', $widget);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_widget_index');
        }

        return $this->render($this->getParameter('theme_name').'/admin/widget/edit.html.twig', array(
            'widget' => $widget,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a widget entity.
     *
     * @Route("/{id}", name="admin_widget_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Widget $widget)
    {
        $form = $this->createDeleteForm($widget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($widget);
            $em->flush($widget);
        }

        return $this->redirectToRoute('admin_widget_index');
    }

    /**
     * Creates a form to delete a widget entity.
     *
     * @param Widget $widget The widget entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Widget $widget)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_widget_delete', array('id' => $widget->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
