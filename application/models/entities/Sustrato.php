<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Sustrato
 */
class Sustrato
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
    private $children;

    /**
     * @var entities\Sustrato
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $taxons;

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taxons = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Sustrato
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
     * Add children
     *
     * @param entities\Sustrato $children
     * @return Sustrato
     */
    public function addSustrato(\entities\Sustrato $children)
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
     * @param entities\Sustrato $parent
     * @return Sustrato
     */
    public function setParent(\entities\Sustrato $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return entities\Sustrato 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add taxons
     *
     * @param entities\Taxon $taxons
     * @return Sustrato
     */
    public function addTaxon(\entities\Taxon $taxons)
    {
        $this->taxons[] = $taxons;
        return $this;
    }

    /**
     * Get taxons
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTaxons()
    {
        return $this->taxons;
    }
}