<?php

namespace Webberdoo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ApiKey
 *
 * @ORM\Table(name="api_key")
 * @ORM\Entity(repositoryClass="Webberdoo\AppBundle\Repository\ApiKeyRepository")
 */
class ApiKey
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_public_key", type="text", nullable=true)
     */
    private $facebookPublicKey;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_secret_key", type="text", nullable=true)
     */
    private $facebookSecretKey;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_public_key", type="text", nullable=true)
     */
    private $twitterPublicKey;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_secret_key", type="text", nullable=true)
     */
    private $twitterSecretKey;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="youtube_api_key", type="string", nullable=true)
     */
    private $youtubeApiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="disqus_shortname", type="string", length=255, nullable=true)
     */
    private $disqusShortname;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set facebookPublicKey
     *
     * @param string $facebookPublicKey
     *
     * @return ApiKey
     */
    public function setFacebookPublicKey($facebookPublicKey)
    {
        $this->facebookPublicKey = $facebookPublicKey;

        return $this;
    }

    /**
     * Get facebookPublicKey
     *
     * @return string
     */
    public function getFacebookPublicKey()
    {
        return $this->facebookPublicKey;
    }

    /**
     * Set facebookSecretKey
     *
     * @param string $facebookSecretKey
     *
     * @return ApiKey
     */
    public function setFacebookSecretKey($facebookSecretKey)
    {
        $this->facebookSecretKey = $facebookSecretKey;

        return $this;
    }

    /**
     * Get facebookSecretKey
     *
     * @return string
     */
    public function getFacebookSecretKey()
    {
        return $this->facebookSecretKey;
    }

    /**
     * Set twitterPublicKey
     *
     * @param string $twitterPublicKey
     *
     * @return ApiKey
     */
    public function setTwitterPublicKey($twitterPublicKey)
    {
        $this->twitterPublicKey = $twitterPublicKey;

        return $this;
    }

    /**
     * Get twitterPublicKey
     *
     * @return string
     */
    public function getTwitterPublicKey()
    {
        return $this->twitterPublicKey;
    }

    /**
     * Set twitterSecretKey
     *
     * @param string $twitterSecretKey
     *
     * @return ApiKey
     */
    public function setTwitterSecretKey($twitterSecretKey)
    {
        $this->twitterSecretKey = $twitterSecretKey;

        return $this;
    }

    /**
     * Get twitterSecretKey
     *
     * @return string
     */
    public function getTwitterSecretKey()
    {
        return $this->twitterSecretKey;
    }

    /**
     * Set youtubeApiKey
     *
     * @param string $youtubeApiKey
     *
     * @return ApiKey
     */
    public function setYoutubeApiKey($youtubeApiKey)
    {
        $this->youtubeApiKey = $youtubeApiKey;

        return $this;
    }

    /**
     * Get youtubeApiKey
     *
     * @return string
     */
    public function getYoutubeApiKey()
    {
        return $this->youtubeApiKey;
    }

    /**
     * Set disqusShortname
     *
     * @param string $disqusShortname
     *
     * @return ApiKey
     */
    public function setDisqusShortname($disqusShortname)
    {
        $this->disqusShortname = $disqusShortname;

        return $this;
    }

    /**
     * Get disqusShortname
     *
     * @return string
     */
    public function getDisqusShortname()
    {
        return $this->disqusShortname;
    }
}

