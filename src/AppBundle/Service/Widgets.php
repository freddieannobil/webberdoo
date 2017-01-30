<?php


namespace Webberdoo\AppBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;

class Widgets
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function parse($position)
    {

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $widget = $em->getRepository('AppBundle:Widget')->findAllWidgets($position);

        return $widget;
    }

}