<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Publicacion
 */
class Publicacion
{
    /**
     * @var string $author
     */
    private $author;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var integer $year
     */
    private $year;

    /**
     * @var string $journal
     */
    private $journal;

    /**
     * @var text $collation
     */
    private $collation;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var string $quote
     */
    private $quote;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $localidades;

    public function __construct()
    {
        $this->localidades = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set author
     *
     * @param string $author
     * @return Publicacion
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
     * Set journal
     *
     * @param string $journal
     * @return Publicacion
     */
    public function setJournal($journal)
    {
        $this->journal = $journal;
        return $this;
    }

    /**
     * Get journal
     *
     * @return string 
     */
    public function getJournal()
    {
        return $this->journal;
    }

    /**
     * Set collation
     *
     * @param text $collation
     * @return Publicacion
     */
    public function setCollation($collation)
    {
        $this->collation = $collation;
        return $this;
    }

    /**
     * Get collation
     *
     * @return text 
     */
    public function getCollation()
    {
        return $this->collation;
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
     * Set quote
     *
     * @param string $quote
     * @return Publicacion
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;
        return $this;
    }

    /**
     * Get quote
     *
     * @return string 
     */
    public function getQuote()
    {
        return $this->quote;
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
     * Add localidades
     *
     * @param entities\Localidad $localidades
     * @return Publicacion
     */
    public function addLocalidad(\entities\Localidad $localidades)
    {
        $this->localidades[] = $localidades;
        return $this;
    }

    /**
     * Get localidades
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLocalidades()
    {
        return $this->localidades;
    }
}