<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Ecosistema
 */
class Ecosistema
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
     * @var entities\Ecosistema
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
     * @return Ecosistema
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
     * @param entities\Ecosistema $children
     * @return Ecosistema
     */
    public function addEcosistema(\entities\Ecosistema $children)
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
     * @param entities\Ecosistema $parent
     * @return Ecosistema
     */
    public function setParent(\entities\Ecosistema $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return entities\Ecosistema 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add taxons
     *
     * @param entities\Taxon $taxons
     * @return Ecosistema
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