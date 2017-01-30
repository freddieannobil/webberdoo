<?php

namespace Webberdoo\AppBundle\Controllers\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Channel controller.
 *@Security("is_granted('ROLE_ADMIN')")
 * @Route("admin")
 */

class DashboardController extends Controller
{
    /**
     * Lists all channel entities.
     *
     * @Route("/", name="admin_dashboard")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();
        $videos = $em->getRepository('AppBundle:Video')->findAll();
        $channels = $em->getRepository('AppBundle:Channel')->findAll();
        $category = $em->getRepository('AppBundle:Category')->findAll();

        return $this->render($this->getParameter('theme_name').'/admin/dashboard.html.twig', array(
            'channels' => $channels,
            'category' => $category,
            'videos' => $videos,
            'users' => $users,
        ));
    }
}
