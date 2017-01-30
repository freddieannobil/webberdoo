<?php

namespace Webberdoo\AppBundle\Controllers\Admin;

use Webberdoo\AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Video controller.
 *@Security("is_granted('ROLE_ADMIN')")
 * @Route("admin/video")
 */
class VideoController extends Controller
{
    /**
     * Lists all video entities.
     *
     * @Route("/", name="admin_video_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('AppBundle:Video')->findAll();

        return $this->render($this->getParameter('theme_name').'/admin/video/index.html.twig', array(
            'videos' => $videos,
        ));
    }

    /**
     * Creates a new video entity.
     *
     * @Route("/new", name="admin_video_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $video = new Video();
        $form = $this->createForm('AppBundle\Form\ImportVideoType', $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $this->container->get('app.insert_video')->setInput($form->getData());

            return $this->redirectToRoute('admin_video_index');
        }

        return $this->render($this->getParameter('theme_name').'/admin/video/new.html.twig', array(
            'video' => $video,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a video entity.
     *
     * @Route("/{id}", name="admin_video_show")
     * @Method("GET")
     */
    public function showAction(Video $video)
    {
        $deleteForm = $this->createDeleteForm($video);

        return $this->render($this->getParameter('theme_name').'/admin/video/show.html.twig', array(
            'video' => $video,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing video entity.
     *
     * @Route("/{id}/edit", name="admin_video_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Video $video)
    {
        $deleteForm = $this->createDeleteForm($video);
        $editForm = $this->createForm('AppBundle\Form\VideoType', $video);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_video_index');
        }

        return $this->render($this->getParameter('theme_name').'/admin/video/edit.html.twig', array(
            'video' => $video,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a video entity.
     *
     * @Route("/{id}", name="admin_video_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Video $video)
    {
        $form = $this->createDeleteForm($video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($video);
            $em->flush($video);
        }

        return $this->redirectToRoute('admin_video_index');
    }

    /**
     * Creates a form to delete a video entity.
     *
     * @param Video $video The video entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Video $video)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_video_delete', array('id' => $video->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
