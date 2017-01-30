<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 19/01/2017
 * Time: 17:36
 */

namespace Webberdoo\AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class SiteSetting
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function siteName()
    {

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $setting = $em->getRepository('AppBundle:Setting')->getFirstSetting();

        if(isset($setting)){
            if(count($setting->getSiteName()) > 0){
                return $setting->getSiteName();
            }
        }
        return false;
        
    }

    public function siteEmail()
    {

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $setting = $em->getRepository('AppBundle:Setting')->getFirstSetting();

        if(isset($setting)){
            if(count($setting->getSiteEmail()) > 0){
                return $setting->getSiteEmail();
            }
        }
        return false;

    }

    public function footerText()
    {

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $setting = $em->getRepository('AppBundle:Setting')->getFirstSetting();

        if(isset($setting)){
            if(count($setting->getFooterText()) > 0){
                return $setting->getFooterText();
            }
        }
        return false;

    }

    public function enableVerifyRegistration()
    {

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $setting = $em->getRepository('AppBundle:Setting')->getFirstSetting();

        if(isset($setting)){
            if(count($setting->getActivateUserVerifyReg()) > 0){
                return $setting->getActivateUserVerifyReg();
            }
        }
        return false;

    }
    
    

}