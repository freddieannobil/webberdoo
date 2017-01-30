<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 29/12/2016
 * Time: 22:06
 */

namespace Webberdoo\AppBundle\Controllers;


use Webberdoo\AppBundle\Entity\ApiKey;
use Webberdoo\AppBundle\Entity\Category;
use Webberdoo\AppBundle\Entity\Channel;
use Webberdoo\AppBundle\Entity\Page;
use Webberdoo\AppBundle\Entity\PasswordHash;
use Webberdoo\AppBundle\Entity\Post;
use Webberdoo\AppBundle\Entity\Setting;
use Webberdoo\AppBundle\Entity\User;
use Webberdoo\AppBundle\Entity\Video;
use Webberdoo\AppBundle\Entity\Widget;
use Doctrine\ORM\Tools\SchemaTool;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class InstallController extends Controller
{
    /**
     * @Route("/install", name="install")
     */
    public function installAction(Request $request)
    {

        try{

            $form = $this->createForm('Webberdoo\AppBundle\Form\Install\AddDatabaseType');
            $form->handleRequest($request);

            $admin_form = $this->createForm('Webberdoo\AppBundle\Form\Install\AddAdminType');
            $admin_form->handleRequest($request);

            $remove_form = $this->createForm('Webberdoo\AppBundle\Form\Install\RemoveFileType');
            $remove_form->handleRequest($request);

            //db
            if ($form->isSubmitted() && $form->isValid()) {

                if($request->request->get('db')){
                    $em = $this->getDoctrine()->getManager();
                    $tool = new SchemaTool($em);
                    $classes = array(
                        $em->getClassMetadata(User::class),
                        $em->getClassMetadata(Page::class),
                        $em->getClassMetadata(Post::class),
                        $em->getClassMetadata(Video::class),
                        $em->getClassMetadata(Category::class),
                        $em->getClassMetadata(Channel::class),
                        $em->getClassMetadata(Widget::class),
                        $em->getClassMetadata(Setting::class),
                        $em->getClassMetadata(ApiKey::class),
                        $em->getClassMetadata(PasswordHash::class),
                       // $em->getClassMetadata(LikedVideo::class),
                    );
                    $tool->createSchema($classes);

                    $request->getSession()
                        ->getFlashBag()
                        ->add('db_success', 'Installed database successfully');

                    return $this->redirectToRoute('install');
                }
            }

            //admin
            if ($admin_form->isSubmitted() && $admin_form->isValid()) {

                if($request->request->get('admin')){
                    $user = new User();
                    $user->setEmail('admin@admin.com');

                    $encoder = $this->container->get('security.password_encoder');
                    $encoded = $encoder->encodePassword($user,'admin');
                    $user->setPassword($encoded);

                    $user->setUsername('admin');
                    $user->setFirstName('Webber');
                    $user->setLastName('doo');
                    $user->setRoles(['ROLE_ADMIN']);
                    $user->setEnabled(true);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();

                    $request->getSession()
                        ->getFlashBag()
                        ->add('admin_success', 'Installed admin details successfully');

                    return $this->redirectToRoute('homepage');
                }

            }

            //remove file
            if ($remove_form->isSubmitted() && $remove_form->isValid()) {

                if ($request->request->get('remove')) {
                    try {

                        unlink('src/AppBundle/Controllers/InstallController.php');
                        unlink('src/AppBundle/Controllers/UpdateController.php');


                        $request->getSession()
                            ->getFlashBag()
                            ->add('remove_success', 'Installer file has been deleted.');

                        return $this->redirectToRoute('homepage');


                    } catch (\Exception $e) {

                        return $this->redirectToRoute('homepage');
                    }
                }

            }


        }catch (Exception $e){
            echo 'There was a problem with the installation: Error - '. $e->getMessage();
        }

        return $this->render($this->getParameter('theme_name').'/install.html.twig',[
            'db_form' => $form->createView(),
            'admin_form' => $admin_form->createView(),
            'remove_form' => $remove_form->createView(),
        ]);
    }

}