<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Ecorregion
 */
class Ecorregion
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
    private $taxons;

    public function __construct()
    {
        $this->taxons = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Ecorregion
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
     * Add taxons
     *
     * @param entities\Taxon $taxons
     * @return Ecorregion
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