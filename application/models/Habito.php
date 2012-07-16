<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * models\Habito
 */
class Habito
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
    private $sustratos;

    public function __construct()
    {
        $this->sustratos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Habito
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
     * Add sustratos
     *
     * @param models\Sustrato $sustratos
     * @return Habito
     */
    public function addSustrato(\models\Sustrato $sustratos)
    {
        $this->sustratos[] = $sustratos;
        return $this;
    }

    /**
     * Get sustratos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSustratos()
    {
        return $this->sustratos;
    }
}