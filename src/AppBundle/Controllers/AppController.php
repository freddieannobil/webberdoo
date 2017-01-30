<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 28/01/2017
 * Time: 17:26
 */

namespace Webberdoo\AppBundle\Controllers;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AppController extends Controller
{
    /**
     * @Route("/")
     *
     * @return Response
     */
    public function indexAction()
    {
        $name = 'fred';
        $view = $this->render($this->container->getParameter('theme_name').'/index.html.twig', compact('name'));

        return $this->container->get('app.cache')->render('demo', $view);
    }

}