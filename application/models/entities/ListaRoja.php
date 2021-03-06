<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\ListaRoja
 */
class ListaRoja
{
    /**
     * @var string $criterionIUCN
     */
    private $criterionIUCN;

    /**
     * @var string $category
     */
    private $category;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $taxons;
	
	/**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $publications;

    public function __construct()
    {
        $this->taxons = new \Doctrine\Common\Collections\ArrayCollection();
		$this->publications = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set criterionIUCN
     *
     * @param string $criterionIUCN
     * @return ListaRoja
     */
    public function setCriterionIUCN($criterionIUCN)
    {
        $this->criterionIUCN = $criterionIUCN;
        return $this;
    }

    /**
     * Get criterionIUCN
     *
     * @return string 
     */
    public function getCriterionIUCN()
    {
        return $this->criterionIUCN;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return ListaRoja
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return ListaRoja
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
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
     * @return ListaRoja
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

    /**
     * Add publications
     *
     * @param entities\Publicacion $publications
     * @return ListaRoja
     */
    public function addPublicacion(\entities\Publicacion $publications)
    {
        $this->publications[] = $publications;
        return $this;
    }

    /**
     * Get publications
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPublications()
    {
        return $this->publications;
    }
}