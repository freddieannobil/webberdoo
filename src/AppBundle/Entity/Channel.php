<?php

namespace Webberdoo\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Channel
 *
 * @ORM\Table(name="channel")
 * @ORM\Entity(repositoryClass="Webberdoo\AppBundle\Repository\ChannelRepository")
 */
class Channel
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
     * @ORM\Column(name="channelId", type="string", length=255, nullable=true)
     */
    private $channelId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="published_on", type="string", length=255, nullable=true)
     */
    private $publishedOn;

    /**
     * @var string
     *
     * @ORM\Column(name="default_thumbnail", type="text", nullable=true)
     */
    private $defaultThumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="medium_thumbnail", type="text", nullable=true)
     */
    private $mediumThumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="high_thumbnail", type="text", nullable=true)
     */
    private $highThumbnail;

    /**
     * @ORM\ManyToMany(targetEntity="Video", mappedBy="channel")
     */
    private $videos;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

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



    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

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
     * Set channelId
     *
     * @param string $channelId
     *
     * @return Channel
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * Get channelId
     *
     * @return string
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Channel
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Channel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set publishedOn
     *
     * @param string $publishedOn
     *
     * @return Channel
     */
    public function setPublishedOn($publishedOn)
    {
        $this->publishedOn = $publishedOn;

        return $this;
    }

    /**
     * Get publishedOn
     *
     * @return string
     */
    public function getPublishedOn()
    {
        return $this->publishedOn;
    }

    /**
     * Set defaultThumbnail
     *
     * @param string $defaultThumbnail
     *
     * @return Channel
     */
    public function setDefaultThumbnail($defaultThumbnail)
    {
        $this->defaultThumbnail = $defaultThumbnail;

        return $this;
    }

    /**
     * Get defaultThumbnail
     *
     * @return string
     */
    public function getDefaultThumbnail()
    {
        return $this->defaultThumbnail;
    }

    /**
     * Set mediumThumbnail
     *
     * @param string $mediumThumbnail
     *
     * @return Channel
     */
    public function setMediumThumbnail($mediumThumbnail)
    {
        $this->mediumThumbnail = $mediumThumbnail;

        return $this;
    }

    /**
     * Get mediumThumbnail
     *
     * @return string
     */
    public function getMediumThumbnail()
    {
        return $this->mediumThumbnail;
    }

    /**
     * Set highThumbnail
     *
     * @param string $highThumbnail
     *
     * @return Channel
     */
    public function setHighThumbnail($highThumbnail)
    {
        $this->highThumbnail = $highThumbnail;

        return $this;
    }

    /**
     * Get highThumbnail
     *
     * @return string
     */
    public function getHighThumbnail()
    {
        return $this->highThumbnail;
    }

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }


}

