<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 19/01/2017
 * Time: 19:14
 */

namespace  Webberdoo\AppBundle\Controllers;

use Webberdoo\AppBundle\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Handler\ErrorLogHandler;


/**
 * UserProfile controller.
 *
 * @Route("user")
 */
class UserProfile extends Controller
{


    /**
     * @Route("/{slug}", name="user_home")
     * @Method("GET")
     */
    public function indexAction($slug)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['slug' => $slug]);

        $total_videos = $em->getRepository('AppBundle:Video')->getUserVideos($slug, 1);

        //pagination
        $total = count($total_videos);
        $maxResults = 12;
        $this->get('app.wdoopaginator')->setPagination($total, $maxResults);
        $video =  $em->getRepository('AppBundle:Video')->getUserVideosPaginated($slug, 1,
            $this->get('app.wdoopaginator')->offset(), $maxResults);


        $paginationLinks = $this->get('app.wdoopaginator')->allLinks(
            $this->generateUrl('user_home', ['slug'=> $slug]) . '?para={nr}'
        );
        //end

        $view = $this->render($this->getParameter('theme_name').'/user/overview.html.twig', [
            'user' => $user,
            'slug' => $slug,
            'videos' => $video,
            'paginationLinks' => $paginationLinks,
            'total' => $total
        ]);

        return $this->get('app.cache')->render('overviewBody', $view);
    }

    /**
     * @Route("/{slug}/waiting-approval", name="user_home_waiting_approval")
     * @Method("GET")
     */
    public function waitingApproval($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['slug' => $slug]);

        $total_videos = $em->getRepository('AppBundle:Video')->getUserVideos($slug, 0);

        //pagination
        $total = count($total_videos);
        $maxResults = 12;
        $this->get('app.wdoopaginator')->setPagination($total, $maxResults);
        $video =  $em->getRepository('AppBundle:Video')->getUserVideosPaginated($slug, 0,
            $this->get('app.wdoopaginator')->offset(), $maxResults);

        $paginationLinks = $this->get('app.wdoopaginator')->allLinks(
            $this->generateUrl('user_home_waiting_approval', ['slug'=> $slug]) . '?para={nr}'
        );
        //end

        $view = $this->render($this->getParameter('theme_name').'/user/waiting_approval.html.twig', [
            'user' => $user,
            'slug' => $slug,
            'videos' => $video,
            'paginationLinks' => $paginationLinks,
            'total' => $total
        ]);

        return $this->get('app.cache')->render('waiting_approvalBody', $view);

    }

    /**
     * @Route("/{slug}/liked", name="user_home_liked")
     */
    public function liked($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['slug' => $slug]);

        $total_videos = $em->getRepository('AppBundle:Video')->getUserVideoLikes($slug, 1);

        //pagination
        $total = count($total_videos);
        $maxResults = 12;
        $this->get('app.wdoopaginator')->setPagination($total, $maxResults);
        $video =  $em->getRepository('AppBundle:Video')->getUserVideoLikesPaginated($slug, 1,
            $this->get('app.wdoopaginator')->offset(), $maxResults);

        $paginationLinks = $this->get('app.wdoopaginator')->allLinks(
            $this->generateUrl('user_home_liked', ['slug'=> $slug]) . '?para={nr}'
        );
        //end

        $view = $this->render($this->getParameter('theme_name').'/user/liked.html.twig', [
            'user' => $user,
            'slug' => $slug,
            'videos' => $video,
            'paginationLinks' => $paginationLinks,
            'total' => $total
        ]);

        return $this->get('app.cache')->render('likedBody', $view);

        
    }

    /**
     * Creates a new video entity.
     *
     * @Route("/submit/{slug}", name="user_submit_video")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $slug)
    {
        $video = new Video();
        $form = $this->createForm('AppBundle\Form\ImportVideoTypeUser', $video);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['slug' => $slug]);

        if ($form->isSubmitted() && $form->isValid()) {
            $video->setStatus('0');
            $this->container->get('app.insert_video')->setInput($form->getData());

            return $this->redirectToRoute('user_home', ['slug' => $this->getUser()->getSlug()]);
        }

        $view = $this->render($this->getParameter('theme_name').'/user/submit.html.twig', array(
            'video' => $video,
            'user' => $user,
            'slug' => $slug,
            'form' => $form->createView(),
        ));

        return $this->get('app.cache')->render('likedBody', $view);
    }

    /**
     * Creates a new video entity.
     *
     * @Route("/{slug}/edit", name="user_home_edit")
     * @Method({"GET", "POST"})
     */
    public function editUser($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['slug' => $slug]);
        
        $form = $this->createForm('AppBundle\Form\UserProfileType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->getDoctrine()->getManager();

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);

            $user->flush();

            return $this->redirectToRoute('user_home', ['slug' => $slug]);
        }

        $view = $this->render($this->getParameter('theme_name').'/user/edit.html.twig', array(
            'user' => $user,
            'slug' => $slug,
            'edit_form' => $form->createView(),
        ));

        return $this->get('app.cache')->render('editBody', $view);

    }



}