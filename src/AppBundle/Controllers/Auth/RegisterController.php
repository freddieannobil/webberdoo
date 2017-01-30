<?php

namespace Webberdoo\AppBundle\Controllers\Auth;

use Webberdoo\AppBundle\Entity\PasswordHash;
use Webberdoo\AppBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {

        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);

            $active_hash = $this->get('app.random_string')->init();
            $user->setToken($active_hash);

            $em->persist($user);
            $em->flush();


            $enableVerification = $this->get('app.setting')->enableVerifyRegistration();

            if($enableVerification){

                $this->addFlash(
                    'success_verify_registration', $this->get('app.sweet_alerts')->registrationVerifySuccess());

                $this->get('app.user_emails')->sendActivation($user->getEmail(), $this->get('app.setting')->siteEmail(), $user->getFirstName(), $active_hash);

                return $this->redirectToRoute('user_register');
            } else {

                $this->addFlash(
                    'success_registration', $this->get('app.sweet_alerts')->registrationSuccess());

                $user->setEnabled(true);
                $em->persist($user);
                $em->flush();

                // login automatically after registration
                return $this->get('security.authentication.guard_handler')
                    ->authenticateUserAndHandleSuccess(
                        $user,
                        $request,
                        $this->get('app.security.login_form_authenticator'),
                        'main'
                    );
            }


        }

        $view = $this->render($this->getParameter('theme_name').'/user/registration.html.twig', [
            'form' => $form->createView() ,
        ]);

        return $this->get('app.cache')->render('registrationBody', $view);
    }
}
