<?php

namespace Webberdoo\AppBundle\Controllers\Admin;

use Webberdoo\AppBundle\Entity\ApiKey;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Webberdoo\AppBundle\Form\ApiKeyType;

/**
 * Apikey controller.
 *@Security("is_granted('ROLE_ADMIN')")
 * @Route("admin/apikey")
 */
class ApiKeyController extends Controller
{
    /**
     * Lists all apiKey entities.
     *
     * @Route("/", name="admin_apikey_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $apiKeys = $em->getRepository('AppBundle:ApiKey')->findAll();

        return $this->render($this->getParameter('theme_name').'/admin/apikey/index.html.twig', array(
            'apiKeys' => $apiKeys,
        ));
    }

    /**
     * Creates a new apiKey entity.
     *
     * @Route("/new", name="admin_apikey_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $apiKey = $em->getRepository('AppBundle:ApiKey')->getFirstSetting();

        if(count($apiKey) == 0)
        {
            $apiKey = new Apikey();
            $form = $this->createForm(ApiKeyType::class, $apiKey);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($apiKey);
                $em->flush($apiKey);

                return $this->redirectToRoute('admin_apikey_index');

            }

            return $this->render($this->getParameter('theme_name').'/admin/apikey/new.html.twig', array(
                'apiKey' => $apiKey,
                'form' => $form->createView(),
            ));
        }else{
            return $this->redirectToRoute('admin_apikey_edit', array('id' => $apiKey->getId()));
        }

    }


    /**
     * Finds and displays a apiKey entity.
     *
     * @Route("/{id}", name="admin_apikey_show")
     * @Method("GET")
     */
    public function showAction(ApiKey $apiKey)
    {
        $deleteForm = $this->createDeleteForm($apiKey);

        return $this->render($this->getParameter('theme_name').'/admin/apikey/show.html.twig', array(
            'apiKey' => $apiKey,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing apiKey entity.
     *
     * @Route("/{id}/edit", name="admin_apikey_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ApiKey $apiKey)
    {
        $deleteForm = $this->createDeleteForm($apiKey);
        $editForm = $this->createForm(ApiKeyType::class, $apiKey);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_apikey_index');
        }

        return $this->render($this->getParameter('theme_name').'/admin/apikey/edit.html.twig', array(
            'apiKey' => $apiKey,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a apiKey entity.
     *
     * @Route("/{id}", name="admin_apikey_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ApiKey $apiKey)
    {
        $form = $this->createDeleteForm($apiKey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($apiKey);
            $em->flush($apiKey);
        }

        return $this->redirectToRoute('admin_apikey_index');
    }

    /**
     * Creates a form to delete a apiKey entity.
     *
     * @param ApiKey $apiKey The apiKey entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ApiKey $apiKey)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_apikey_delete', array('id' => $apiKey->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
