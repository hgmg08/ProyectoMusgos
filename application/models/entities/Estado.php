<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Estado
 */
class Estado
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $FVCode
     */
    private $FVCode;

    /**
     * @var string $ISOCode
     */
    private $ISOCode;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $localidad;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $municipio;

    public function __construct()
    {
        $this->localidad = new \Doctrine\Common\Collections\ArrayCollection();
        $this->municipio = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Estado
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
     * Set FVCode
     *
     * @param string $fVCode
     * @return Estado
     */
    public function setFVCode($fVCode)
    {
        $this->FVCode = $fVCode;
        return $this;
    }

    /**
     * Get FVCode
     *
     * @return string 
     */
    public function getFVCode()
    {
        return $this->FVCode;
    }

    /**
     * Set ISOCode
     *
     * @param string $iSOCode
     * @return Estado
     */
    public function setISOCode($iSOCode)
    {
        $this->ISOCode = $iSOCode;
        return $this;
    }

    /**
     * Get ISOCode
     *
     * @return string 
     */
    public function getISOCode()
    {
        return $this->ISOCode;
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
     * Add localidad
     *
     * @param entities\Localidad $localidad
     * @return Estado
     */
    public function addLocalidad(\entities\Localidad $localidad)
    {
        $this->localidad[] = $localidad;
        return $this;
    }

    /**
     * Get localidad
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Add municipio
     *
     * @param entities\Municipio $municipio
     * @return Estado
     */
    public function addMunicipio(\entities\Municipio $municipio)
    {
        $this->municipio[] = $municipio;
        return $this;
    }

    /**
     * Get municipio
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }
}