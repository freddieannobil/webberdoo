<?php


namespace Webberdoo\AppBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;

class NavMenu
{
    private $container;
    private $theme;

    public function __construct(ContainerInterface $container, $theme)
    {
        $this->container = $container;
        $this->theme = $theme;
    }

    public function parseMainMenu()
    {
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $page = $em->getRepository('AppBundle:Page')->findAll();
        $category = $em->getRepository('AppBundle:Category')->findAll();
        $channel = $em->getRepository('AppBundle:Channel')->findAll();

        return $this->container->get('templating')->render($this->theme.'/layout/inc/navmenu.html.twig', array(
            'page' => $page,
            'category' => $category,
            'channel' => $channel,
        ));
    }

    public function parseFooterPageMenu()
    {
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        return $em->getRepository('AppBundle:Page')->findAll();
    }

}