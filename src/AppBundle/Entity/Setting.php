<?php

namespace Webberdoo\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Setting
 *
 * @ORM\Table(name="setting")
 * @ORM\Entity(repositoryClass="Webberdoo\AppBundle\Repository\SettingRepository")
 */
class Setting
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
     * @Assert\Url()
     * @ORM\Column(name="site_url", type="string", length=255, nullable=true)
     */
    private $siteUrl;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="site_name", type="string", length=255, nullable=true)
     */
    private $siteName;

    /**
     * @var string
     * @Assert\Email()
     * @Assert\NotBlank()
     * @ORM\Column(name="site_email", type="string", length=255, nullable=true)
     */
    private $siteEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_text", type="string", length=255, nullable=true)
     */
    private $footerText;

    /**
     * @var string
     *
     * @ORM\Column(name="user_verify_reg", type="boolean", length=1, nullable=true)
     */
    private $activateUserVerifyReg;


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
     * Set siteUrl
     *
     * @param string $siteUrl
     *
     * @return Setting
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    /**
     * Get siteUrl
     *
     * @return string
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * Set siteName
     *
     * @param string $siteName
     *
     * @return Setting
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get siteName
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set siteEmail
     *
     * @param string $siteEmail
     *
     * @return Setting
     */
    public function setSiteEmail($siteEmail)
    {
        $this->siteEmail = $siteEmail;

        return $this;
    }

    /**
     * Get siteEmail
     *
     * @return string
     */
    public function getSiteEmail()
    {
        return $this->siteEmail;
    }

    /**
     * Set footerText
     *
     * @param string $footerText
     *
     * @return Setting
     */
    public function setFooterText($footerText)
    {
        $this->footerText = $footerText;

        return $this;
    }

    /**
     * Get footerText
     *
     * @return string
     */
    public function getFooterText()
    {
        return $this->footerText;
    }

    /**
     * @return mixed
     */
    public function getActivateUserVerifyReg()
    {
        return $this->activateUserVerifyReg;
    }

    /**
     * @param mixed $activateUserVerifyReg
     */
    public function setActivateUserVerifyReg($activateUserVerifyReg)
    {
        $this->activateUserVerifyReg = $activateUserVerifyReg;
    }



}

