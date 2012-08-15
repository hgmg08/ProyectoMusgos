<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Rank
 */
class Rank
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $taxon;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $children;

    /**
     * @var entities\Rank
     */
    private $parent;

    public function __construct()
    {
        $this->taxon = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Rank
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add taxon
     *
     * @param entities\Taxon $taxon
     * @return Rank
     */
    public function addTaxon(\entities\Taxon $taxon)
    {
        $this->taxon[] = $taxon;
        return $this;
    }

    /**
     * Get taxon
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTaxon()
    {
        return $this->taxon;
    }

    /**
     * Add children
     *
     * @param entities\Rank $children
     * @return Rank
     */
    public function addRank(\entities\Rank $children)
    {
        $this->children[] = $children;
        return $this;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param entities\Rank $parent
     * @return Rank
     */
    public function setParent(\entities\Rank $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return entities\Rank 
     */
    public function getParent()
    {
        return $this->parent;
    }
}