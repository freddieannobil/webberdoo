<?php

namespace Webberdoo\AppBundle\Controllers\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ActivationController
 * @package UserBundle\Controller
 */
class ActivationController extends Controller
{
    /**
     * Check User account for activation
     *
     * @Route("/activate/{active_hash}", name="user_activate")
     */
     public function activateAction($active_hash)
     {
         $em = $this->getDoctrine()->getManager();

         $user = $em->getRepository('AppBundle:User')->findOneBy(['token'=> $active_hash, 'enabled' => false]);

         if(!$user || $user->getToken() != $active_hash){
             $this->addFlash(
                 'error_activation', $this->get('app.sweet_alerts')->registrationActivationError());

             return $this->redirectToRoute('user_register');
         }

          return $this->activateAccount($active_hash);
     }


    /**
     * Activate user account
     *
     * @param $token
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activateAccount($token)
     {

         $em = $this->getDoctrine()->getManager();

         $user2 = $em->getRepository('AppBundle:User')->getUserByConfirmationToken($token);

         $user2->setEnabled(true);
         $user2->setToken(null);
         $em->flush();

         $this->addFlash(
             'success_activation', $this->get('app.sweet_alerts')->registrationActivationSuccess());

         return $this->redirectToRoute('security_login');

     }
}
