<?php

namespace Webberdoo\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="Webberdoo\AppBundle\Repository\VideoRepository")
 */
class Video
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
     * @var int
     *
     * @ORM\Column(name="video_api_id", type="string", nullable=true)
     */
    private $videoApiId;

    /**
     * @var string
     *
     * @ORM\Column(name="published", type="string", length=255, nullable=true)
     */
    private $published;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_cid", type="string", length=255, nullable=true)
     */
    private $channelCid;

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
     * @ORM\Column(name="keyword", type="text", nullable=true)
     */
    private $keyword;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail_default", type="text", nullable=true)
     */
    private $thumbnailDefault;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail_medium", type="text", nullable=true)
     */
    private $thumbnailMedium;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail_high", type="text", nullable=true)
     */
    private $thumbnailHigh;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_title", type="string", length=255, nullable=true)
     */
    private $channelTitle;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="platform", type="string", length=255, nullable=true)
     */
    private $platform;

    /**
     * @var string
     *
     * @ORM\Column(name="count_visitor", type="integer", length=255)
     */
    private $countVisitor;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="boolean", length=1, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="featured", type="boolean", length=1, nullable=true)
     */
    private $featured;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="videos")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="videos")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="Channel", inversedBy="videos")
     */
    private $channel;

    /**
    *  @ORM\Column(name="likes", type="integer", length=255)
    */
    private $likes;

    /**
     *  @ORM\Column(name="like_user_id", type="integer", length=255)
     */
    private $like_user_id;

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
    * @ORM\ManyToMany(targetEntity="User")
    * @ORM\JoinTable(name="video_like")
    */
    private $userLikes;

    private $import_feed;

    private $youtubeUrl;

    private $channelId;

    private $addKeywords;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->channel = new ArrayCollection();
        $this->userLikes = new ArrayCollection();
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
     * Set videoApiId
     *
     * @param integer $videoApiId
     *
     * @return Video
     */
    public function setVideoApiId($videoApiId)
    {
        $this->videoApiId = $videoApiId;

        return $this;
    }

    /**
     * Get videoApiId
     *
     * @return int
     */
    public function getVideoApiId()
    {
        return $this->videoApiId;
    }

    /**
     * Set published
     *
     * @param string $published
     *
     * @return Video
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return string
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Video
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set channelCid
     *
     * @param string $channelCid
     *
     * @return Video
     */
    public function setChannelCid($channelCid)
    {
        $this->channelCid = $channelCid;

        return $this;
    }

    /**
     * Get channelCid
     *
     * @return string
     */
    public function getChannelCid()
    {
        return $this->channelCid;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Video
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
     * @return Video
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
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Video
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set thumbnailDefault
     *
     * @param string $thumbnailDefault
     *
     * @return Video
     */
    public function setThumbnailDefault($thumbnailDefault)
    {
        $this->thumbnailDefault = $thumbnailDefault;

        return $this;
    }

    /**
     * Get thumbnailDefault
     *
     * @return string
     */
    public function getThumbnailDefault()
    {
        return $this->thumbnailDefault;
    }

    /**
     * Set thumbnailMedium
     *
     * @param string $thumbnailMedium
     *
     * @return Video
     */
    public function setThumbnailMedium($thumbnailMedium)
    {
        $this->thumbnailMedium = $thumbnailMedium;

        return $this;
    }

    /**
     * Get thumbnailMedium
     *
     * @return string
     */
    public function getThumbnailMedium()
    {
        return $this->thumbnailMedium;
    }

    /**
     * Set thumbnailHigh
     *
     * @param string $thumbnailHigh
     *
     * @return Video
     */
    public function setThumbnailHigh($thumbnailHigh)
    {
        $this->thumbnailHigh = $thumbnailHigh;

        return $this;
    }

    /**
     * Get thumbnailHigh
     *
     * @return string
     */
    public function getThumbnailHigh()
    {
        return $this->thumbnailHigh;
    }

    /**
     * Set channelTitle
     *
     * @param string $channelTitle
     *
     * @return Video
     */
    public function setChannelTitle($channelTitle)
    {
        $this->channelTitle = $channelTitle;

        return $this;
    }

    /**
     * Get channelTitle
     *
     * @return string
     */
    public function getChannelTitle()
    {
        return $this->channelTitle;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Video
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set platform
     *
     * @param string $platform
     *
     * @return Video
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set countVisitor
     *
     * @param string $countVisitor
     *
     * @return Video
     */
    public function setCountVisitor($countVisitor)
    {
        $this->countVisitor = $countVisitor;

        return $this;
    }

    /**
     * Get countVisitor
     *
     * @return string
     */
    public function getCountVisitor()
    {
        return $this->countVisitor;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Video
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set likes
     *
     * @param string $likes
     *
     * @return Video
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return string
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set featured
     *
     * @param string $featured
     *
     * @return Video
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return string
     */
    public function getFeatured()
    {
        return $this->featured;
    }


    /**
     * @return mixed
     */
    public function getImportFeed()
    {
        return $this->import_feed;
    }

    /**
     * @param mixed $import_feed
     */
    public function setImportFeed($import_feed)
    {
        $this->import_feed = $import_feed;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getYoutubeUrl()
    {
        return $this->youtubeUrl;
    }

    /**
     * @param mixed $youtubeUrl
     */
    public function setYoutubeUrl($youtubeUrl)
    {
        $this->youtubeUrl = $youtubeUrl;
    }

    /**
     * @return mixed
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * @param mixed $channelId
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    }

    /**
     * @return mixed
     */
    public function getAddKeywords()
    {
        return $this->addKeywords;
    }

    /**
     * @param mixed $addKeywords
     */
    public function setAddKeywords($addKeywords)
    {
        $this->addKeywords = $addKeywords;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param mixed $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }


    public function addCategory(Category $category)
    {
        $this->category[] = $category;
    }

    public function addChannel(Channel $channel)
    {
        $this->channel[] = $channel;
    }

    public function addUser(User $user)
    {
        $this->user[] = $user;
    }

    public function addLike(Like $like)
    {
        $this->likes[] = $like;
    }

    public function getCategories()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getLikeUserId()
    {
        return $this->like_user_id;
    }

    /**
     * @param mixed $like_user_id
     */
    public function setLikeUserId($like_user_id)
    {
        $this->like_user_id = $like_user_id;
    }

    public function addUserLikes(User $user)
    {
        //if already liked video just return
        if($this->userLikes->contains($user)){
            return true;
        }
        //add likes to video on join table - user id and video id
        $this->userLikes[] = $user;

        return false;
    }

    /**
     *
     * @return ArrayCollection|User[]
     */
    public function getUserLikes()
    {
        return $this->userLikes;
    }

    public function removeUserLikes(User $user)
    {
        $this->userLikes->removeElement($user);
    }




}

