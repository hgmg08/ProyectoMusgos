<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\CambioClimatico
 */
class CambioClimatico
{
    /**
     * @var string $criterion
     */
    private $criterion;

    /**
     * @var string $author
     */
    private $author;

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
     * Set criterion
     *
     * @param string $criterion
     * @return CambioClimatico
     */
    public function setCriterion($criterion)
    {
        $this->criterion = $criterion;
        return $this;
    }

    /**
     * Get criterion
     *
     * @return string 
     */
    public function getCriterion()
    {
        return $this->criterion;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return CambioClimatico
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
     * @return CambioClimatico
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