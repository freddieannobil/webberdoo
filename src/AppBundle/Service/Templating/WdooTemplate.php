<?php
/**
 * Created by Freddie Annobil-Dodoo @ Webberdoo.co.uk
 */

namespace  Webberdoo\AppBundle\Service\Templating;


use Symfony\Component\DependencyInjection\ContainerInterface;

class WdooTemplate
{

    /**
     * @var ContainerInterface
     */
    private $container;


    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
    }

    public function render($tag, $view, $param)
    {

        $view = $this->container->get('templating')->render($this->container->getParameter('theme_name').'/'.$view, $param);

        return $this->container->get('app.cache')->render($tag, $view);
    }

}