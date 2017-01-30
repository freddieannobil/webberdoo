<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 29/01/2017
 * Time: 15:45
 */

namespace Webberdoo\AppBundle\Controllers;


use Webberdoo\AppBundle\Form\RecoverPasswordType;
use Webberdoo\AppBundle\Form\ResetPasswordType;
use Webberdoo\AppBundle\Form\UserProfileType;
use Webberdoo\AppBundle\Form\Validation\UserResetValidation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ForgotPasswordController
 * @package AppBundle\Controller
 */
class ForgotPasswordController extends Controller
{
    /**
     * @Route("/recover", name="recover_password")
     */
    public function recoverAction(Request $request)
    {
        $form = $this->createForm(RecoverPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $user =  $em->getRepository('AppBundle:User')->findOneBy(['email' => $data->getEmail()]);

            if(!$user){

                $this->addFlash(
                    'password_user_error', 'Could not find that email in the system');

                return $this->redirectToRoute('recover_password');
            }else{

               //create recover token and insert into database then send email.
                $token = $this->get('app.random_string')->init();
                $user->setRecoverHash($token);
                $em->flush();

                $this->get('app.user_emails')->sendResetPasswordLink($user->getEmail(), $this->get('app.setting')->siteEmail(), $user->getFirstName(), $token);

                $this->addFlash(
                    'success_reset_email_sent', $this->get('app.sweet_alerts')->resetEmailSentSuccess());

                return $this->redirectToRoute('homepage');
            }

        }

        $view = $this->render($this->getParameter('theme_name').'/recover_password/recover.html.twig', [
            'form' => $form->createView() ,
        ]);

        return $this->get('app.cache')->render('recoverBody', $view);
    }


    /**
     * Check User account for activation
     *
     * @Route("/reset-password/{token}", name="reset_password")
     */
    public function resetPassword(Request $request, $token)
    {

        $form = $this->createForm(UserProfileType::class);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $user =  $em->getRepository('AppBundle:User')->findOneBy(['recover_hash' => $token]);

        if(!$user || $user->getRecoverHash() != $token){

            $this->addFlash(
                'reset_token_error', $this->get('app.sweet_alerts')->resetTokenError());

            return $this->redirectToRoute('homepage');
        }


        $form = $this->createForm(ResetPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);
            $user->setRecoverHash(null);

            $em->flush();

            $this->addFlash(
                'success_reset_password', $this->get('app.sweet_alerts')->resetPasswordSuccess());

            return $this->redirectToRoute('security_login');
        }

        $view = $this->render($this->getParameter('theme_name').'/recover_password/reset.html.twig', [
            'edit_form' => $form->createView() ,
        ]);

        return $this->get('app.cache')->render('resetPasswordBody', $view);

    }

}