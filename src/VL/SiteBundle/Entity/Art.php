<?php

namespace VL\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use VL\SiteBundle\Utils\Site as site;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Art
 */
class Art
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $nick_name;

    /**
     * @var string
     */
    private $nazvanie;

    /**
     * @var string
     */
    private $short_cont;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $img;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $is_public;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var string
     */
    private $keywords;

    /**
     * @var string
     */
    private $descriptin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;

    /**
     * @var \VL\SiteBundle\Entity\Category
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Art
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Art
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set nick_name
     *
     * @param string $nickName
     * @return Art
     */
    public function setNickName($nickName)
    {
        $this->nick_name = $nickName;

        return $this;
    }

    /**
     * Get nick_name
     *
     * @return string 
     */
    public function getNickName()
    {
        return $this->nick_name;
    }

    /**
     * Set nazvanie
     *
     * @param string $nazvanie
     * @return Art
     */
    public function setNazvanie($nazvanie)
    {
        $this->nazvanie = $nazvanie;

        return $this;
    }

    /**
     * Get nazvanie
     *
     * @return string 
     */
    public function getNazvanie()
    {
        return $this->nazvanie;
    }

    /**
     * Set short_cont
     *
     * @param string $shortCont
     * @return Art
     */
    public function setShortCont($shortCont)
    {
        $this->short_cont = $shortCont;

        return $this;
    }

    /**
     * Get short_cont
     *
     * @return string 
     */
    public function getShortCont()
    {
        return $this->short_cont;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Art
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Art
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Art
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set is_public
     *
     * @param boolean $isPublic
     * @return Art
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;

        return $this;
    }

    /**
     * Get is_public
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Art
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Art
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set descriptin
     *
     * @param string $descriptin
     * @return Art
     */
    public function setDescriptin($descriptin)
    {
        $this->descriptin = $descriptin;

        return $this;
    }

    /**
     * Get descriptin
     *
     * @return string 
     */
    public function getDescriptin()
    {
        return $this->descriptin;
    }

    /**
     * Add comments
     *
     * @param \VL\SiteBundle\Entity\Comment $comments
     * @return Art
     */
    public function addComment(\VL\SiteBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \VL\SiteBundle\Entity\Comment $comments
     */
    public function removeComment(\VL\SiteBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set category
     *
     * @param \VL\SiteBundle\Entity\Category $category
     * @return Art
     */
    public function setCategory(\VL\SiteBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \VL\SiteBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @ORM\PrePersist
     */
    public function setTokenValue()
    {
        if(!$this->getToken()) {
            $this->token = sha1($this->getAuthor().rand(11111, 99999));
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt())
        {
            $this->created_at = new \DateTime();
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setTypeAtValue()
    {
        $this->type=$this->category;
    }

    public function getNazvanieSlug()
    {
        return site::slugify($this->getNazvanie());
    }

    public function getAuthorSlug()
    {
        return site::slugify($this->getAuthor());
    }

    public function __toString()
    {
       // return $this->getType() ? $this->getType() : "";
        return $this->getNazvanie() ? $this->getNazvanie() : "";
    }
}
