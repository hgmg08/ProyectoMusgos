<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Municipio
 */
class Municipio
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
    private $localidad;

    /**
     * @var entities\Estado
     */
    private $estado;

    public function __construct()
    {
        $this->localidad = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Municipio
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
     * Add localidad
     *
     * @param entities\Localidad $localidad
     * @return Municipio
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
     * Set estado
     *
     * @param entities\Estado $estado
     * @return Municipio
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
}