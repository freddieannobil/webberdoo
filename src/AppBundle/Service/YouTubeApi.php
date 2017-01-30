<?php


namespace Webberdoo\AppBundle\Service;

use Madcoda\Youtube;
use Symfony\Component\DependencyInjection\ContainerInterface;

class YouTubeApi
{
    private $api_key;
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
      //  $this->youtube = new Youtube(['key' =>$api_key]);

        $this->container = $container;
        $em = $container->get('doctrine.orm.default_entity_manager');

        $key = $em->getRepository('AppBundle:ApiKey')->getFirstSetting();
        $this->youtube = new Youtube(['key' =>$key->getYoutubeApiKey()]);
    }

    /**
     * @param   string $params
     * @param   bool   $bool
     *
     * @return mixed
     */
    public function searchAdvanced($params, $bool = true)
    {
        return $this->youtube->searchAdvanced($params, $bool);
    }

    /**
     * @param int $id
     *
     * @return \StdClass
     */
    public function getVideoInfo($id)
    {
        return $this->youtube->getVideoInfo($id);
    }

    // Search playlists, channels and videos, Return an array of PHP objects
    /**
     * @param mixed $query
     *
     * @return array
     */
    public function search($query)
    {
        return $this->youtube->search($query);
    }

    // Search only Videos, Return an array of PHP objects
    /**
     * @param mixed $query
     *
     * @return \StdClass
     */
    public function searchVideos($query)
    {
        return $this->youtube->searchVideos($query);
    }

    // Search only Videos in a given channel, Return an array of PHP objects
    /**
     * @param mixed $keyword
     * @param int   $id
     *
     * @return object
     */
    public function searchChannelVideos($keyword, $id)
    {
        return $this->youtube->searchChannelVideos($keyword, $id, 50);
    }

    // Return a std PHP object
    /**
     * @param string $name
     *
     * @return \StdClass
     */
    public function getChannelByName($name)
    {
        return $this->youtube->getChannelByName($name);
    }

    // Return a std PHP object
    /**
     * @param int $id
     *
     * @return \StdClass
     */
    public function getChannelById($id)
    {
        return $this->youtube->getChannelById($id);
    }

    // Return a std PHP object
    /**
     * @param int $id
     *
     * @return \StdClass
     */
    public function getPlaylistById($id)
    {
        return $this->youtube->getPlaylistById($id);
    }

    // Return an array of PHP objects
    /**
     * @param int $id
     *
     * @return array
     */
    public function getPlaylistsByChannelId($id)
    {
        return $this->youtube->getPlaylistsByChannelId($id);
    }

    // Return an array of PHP objects
    /**
     * @param int $id
     *
     * @return array
     */
    public function getPlaylistItemsByPlaylistId($id)
    {
        return $this->youtube->getPlaylistItemsByPlaylistId($id);
    }

    // Return an array of PHP objects
    /**
     * @param int $id
     *
     * @return array
     */
    public function getActivitiesByChannelId($id)
    {
        return $this->youtube->getActivitiesByChannelId($id);
    }

    /**
     * @param mixed $videoUrl
     *
     * @return string
     *
     * @throws \Exception
     */
    public function parseVIdFromURL($videoUrl)
    {
        return $this->youtube->parseVIdFromURL($videoUrl);
    }

}