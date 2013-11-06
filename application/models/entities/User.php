<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\User
 */
class User
{
    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var entities\Role
     */
    private $role;
	
	/**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $created_taxons;
	
	public function __construct()
    {
        $this->created_taxons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modified_taxons = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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
     * Set role
     *
     * @param entities\Role $role
     * @return User
     */
    public function setRole(\entities\Role $role = null)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     *
     * @return entities\Role 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get created_taxons
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCreatedTaxons()
    {
        return $this->created_taxons;
    }

    /**
     * Add created_taxons
     *
     * @param entities\Taxon $createdTaxons
     * @return User
     */
    public function addTaxon(\entities\Taxon $createdTaxons)
    {
        $this->created_taxons[] = $createdTaxons;
        return $this;
    }
}