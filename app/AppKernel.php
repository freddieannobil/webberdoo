<?php
namespace Webberdoo\App;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 28/01/2017
 * Time: 16:46
 */
class AppKernel extends Kernel
{

    /**
     * Returns an array of bundles to register.
     *
     * @return \Symfony\Component\HttpKernel\Bundle\BundleInterface An array of bundle instances
     */
    public function registerBundles()
    {
        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \Webberdoo\AppBundle\AppBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

        ];

       if ($this->getEnvironment() == 'dev') {
           $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
           $bundles[] = new \Symfony\Bundle\DebugBundle\DebugBundle();
           $bundles[] = new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
           $bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
    }

        return $bundles;

    }

    /**
     * Loads the container configuration.
     *
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader A LoaderInterface instance
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');

       $isDevEnv =  $this->getEnvironment() == 'dev';
        $loader->load(function (ContainerBuilder $container) use($isDevEnv){
             if($isDevEnv){
                 $container->loadFromExtension('web_profiler', [
                     'toolbar' => true
                 ]);
             }

             if($isDevEnv){
                 $container->loadFromExtension('framework', [
                     'router' => [
                         'resource' => '%kernel.root_dir%/config/routing_dev.yml'
                     ]

                 ]);
             }
        });
    }
}