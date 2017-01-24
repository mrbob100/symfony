<?php

namespace VL\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use VL\SiteBundle\Utils\Site as site;
/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;


    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $arts;

    private $activeArts;

    private $moreArts;

    const MAX_ARTS_ON_HOMEPAGE=4;
    const HOME_PAGE=6;
    const CATEGORY_CTATYA_NUMBER=1;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->arts = new \Doctrine\Common\Collections\ArrayCollection();

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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
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
     * Add arts
     *
     * @param \VL\SiteBundle\Entity\Art $arts
     * @return Category
     */
    public function addArt(\VL\SiteBundle\Entity\Art $arts)
    {
        $this->arts[] = $arts;

        return $this;
    }

    /**
     * Remove arts
     *
     * @param \VL\SiteBundle\Entity\Art $arts
     */
    public function removeArt(\VL\SiteBundle\Entity\Art $arts)
    {
        $this->arts->removeElement($arts);
    }

    /**
     * Get arts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArts()
    {
        return $this->arts;
    }
    /**
     * @ORM\PrePersist
     */
    public function setSlugValue()
    {
        $this->slug = site::slugify($this->getName());
    }

    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }

    public function setActiveArts($arts)
    {
        $this->activeArts = $arts;
    }

    public function getActiveArts()
    {
        return $this->activeArts;
    }




    public function setMoreArts($arts)
    {
        $this->moreArts = $arts >=  0 ? $arts : 0;
    }

    public function getMoreArts()
    {
        return $this->moreArts;
    }

}
