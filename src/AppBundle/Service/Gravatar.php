<?php
namespace Webberdoo\AppBundle\Service;

/**
 * Class Gravatar
 * @package Doowebdev\GravBundle\Lib
 */
/**
 * Class Gravatar
 * @package Doowebdev\Bundles\GravatarBundle
 */
class Gravatar
{
    /**
     * @var
     */
    protected $gravUrl = "http://www.gravatar.com/avatar/";

    /**
     * @var
     */
    protected $default= "mm";

    /**
     * @var
     */
    protected $container;

    /**
     * @param string $email
     * @param null   $size
     *
     * @return  string
     */
    public function gravatar($email, $size = null)
    {
        if ($size) {
            $url = $this->gravUrl . md5(strtolower(trim($email))) .
                "?d=" .
                urlencode($this->default) .
                "&s=" . $size;
        } else {
            $url = $this->gravUrl . md5(strtolower(trim($email))) .
                "?d=" .
                urlencode($this->default) .
                "&s=" . '200';
        }

        return $url;
    }
}
