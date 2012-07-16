<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * models\Publicacion
 */
class Publicacion
{
    /**
     * @var string $title
     */
    private $title;

    /**
     * @var integer $year
     */
    private $year;

    /**
     * @var text $data
     */
    private $data;

    /**
     * @var datetime $creationDate
     */
    private $creationDate;

    /**
     * @var datetime $modificationDate
     */
    private $modificationDate;

    /**
     * @var text $comments
     */
    private $comments;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var string $status
     */
    private $status;

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
    private $authors;

    public function __construct()
    {
        $this->taxons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return Publicacion
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Publicacion
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set data
     *
     * @param text $data
     * @return Publicacion
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get data
     *
     * @return text 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set creationDate
     *
     * @param datetime $creationDate
     * @return Publicacion
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * Get creationDate
     *
     * @return datetime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set modificationDate
     *
     * @param datetime $modificationDate
     * @return Publicacion
     */
    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
        return $this;
    }

    /**
     * Get modificationDate
     *
     * @return datetime 
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * Set comments
     *
     * @param text $comments
     * @return Publicacion
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * Get comments
     *
     * @return text 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Publicacion
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Publicacion
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
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
     * @param models\Taxon $taxons
     * @return Publicacion
     */
    public function addTaxon(\models\Taxon $taxons)
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
     * Add authors
     *
     * @param models\Autor $authors
     * @return Publicacion
     */
    public function addAutor(\models\Autor $authors)
    {
        $this->authors[] = $authors;
        return $this;
    }

    /**
     * Get authors
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }
}