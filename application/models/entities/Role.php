<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Role
 */
class Role
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $users;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $operations;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->operations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Role
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
     * Set description
     *
     * @param string $description
     * @return Role
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
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
     * Add users
     *
     * @param entities\User $users
     * @return Role
     */
    public function addUser(\entities\User $users)
    {
        $this->users[] = $users;
        return $this;
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add operations
     *
     * @param entities\Operation $operations
     * @return Role
     */
    public function addOperation(\entities\Operation $operations)
    {
        $this->operations[] = $operations;
        return $this;
    }

    /**
     * Get operations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOperations()
    {
        return $this->operations;
    }
}