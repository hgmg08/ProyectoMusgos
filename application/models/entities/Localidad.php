<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Localidad
 */
class Localidad
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var integer $minAltitude
     */
    private $minAltitude;

    /**
     * @var integer $maxAltitude
     */
    private $maxAltitude;

    /**
     * @var string $latitude
     */
    private $latitude;

    /**
     * @var string $longitude
     */
    private $longitude;

    /**
     * @var text $collection
     */
    private $collection;

    /**
     * @var datetime $collectionDate
     */
    private $collectionDate;

    /**
     * @var string $hebarium
     */
    private $hebarium;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var entities\Municipio
     */
    private $municipio;

    /**
     * @var entities\Estado
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $publications;
	
	/**
     * @var entities\Taxon
     */
    private $taxon;


    public function __construct()
    {
        $this->publications = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Localidad
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
     * Set minAltitude
     *
     * @param integer $minAltitude
     * @return Localidad
     */
    public function setMinAltitude($minAltitude)
    {
        $this->minAltitude = $minAltitude;
        return $this;
    }

    /**
     * Get minAltitude
     *
     * @return integer 
     */
    public function getMinAltitude()
    {
        return $this->minAltitude;
    }

    /**
     * Set maxAltitude
     *
     * @param integer $maxAltitude
     * @return Localidad
     */
    public function setMaxAltitude($maxAltitude)
    {
        $this->maxAltitude = $maxAltitude;
        return $this;
    }

    /**
     * Get maxAltitude
     *
     * @return integer 
     */
    public function getMaxAltitude()
    {
        return $this->maxAltitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Localidad
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Localidad
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set collection
     *
     * @param text $collection
     * @return Localidad
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Get collection
     *
     * @return text 
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set collectionDate
     *
     * @param datetime $collectionDate
     * @return Localidad
     */
    public function setCollectionDate($collectionDate)
    {
        $this->collectionDate = $collectionDate;
        return $this;
    }

    /**
     * Get collectionDate
     *
     * @return datetime 
     */
    public function getCollectionDate()
    {
        return $this->collectionDate;
    }

    /**
     * Set hebarium
     *
     * @param string $hebarium
     * @return Localidad
     */
    public function setHebarium($hebarium)
    {
        $this->hebarium = $hebarium;
        return $this;
    }

    /**
     * Get hebarium
     *
     * @return string 
     */
    public function getHebarium()
    {
        return $this->hebarium;
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
     * Set municipio
     *
     * @param entities\Municipio $municipio
     * @return Localidad
     */
    public function setMunicipio(\entities\Municipio $municipio = null)
    {
        $this->municipio = $municipio;
        return $this;
    }

    /**
     * Get municipio
     *
     * @return entities\Municipio 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set estado
     *
     * @param entities\Estado $estado
     * @return Localidad
     */
    public function setEstado(\entities\Estado $estado = null)
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * Get estado
     *
     * @return entities\Estado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add publications
     *
     * @param entities\Publicacion $publications
     * @return Localidad
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


    /**
     * Set taxon
     *
     * @param entities\Taxon $taxon
     * @return Localidad
     */
    public function setTaxon(\entities\Taxon $taxon = null)
    {
        $this->taxon = $taxon;
        return $this;
    }

    /**
     * Get taxon
     *
     * @return entities\Taxon 
     */
    public function getTaxon()
    {
        return $this->taxon;
    }
}