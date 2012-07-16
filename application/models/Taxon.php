<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * models\Taxon
 */
class Taxon
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var boolean $acceptedName
     */
    private $acceptedName;

    /**
     * @var boolean $endemic
     */
    private $endemic;

    /**
     * @var string $authorInitials
     */
    private $authorInitials;

    /**
     * @var string $synonimClasification
     */
    private $synonimClasification;

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
     * @var text $modificationComments
     */
    private $modificationComments;

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
    private $children_rank;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $children_synonyms;

    /**
     * @var models\Rank
     */
    private $rank;

    /**
     * @var models\Taxon
     */
    private $parent_rank;

    /**
     * @var models\Taxon
     */
    private $parent_synonyms;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $authors;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $publications;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $sustratos;

    public function __construct()
    {
        $this->children_rank = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children_synonyms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sustratos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Taxon
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
     * Set acceptedName
     *
     * @param boolean $acceptedName
     * @return Taxon
     */
    public function setAcceptedName($acceptedName)
    {
        $this->acceptedName = $acceptedName;
        return $this;
    }

    /**
     * Get acceptedName
     *
     * @return boolean 
     */
    public function getAcceptedName()
    {
        return $this->acceptedName;
    }

    /**
     * Set endemic
     *
     * @param boolean $endemic
     * @return Taxon
     */
    public function setEndemic($endemic)
    {
        $this->endemic = $endemic;
        return $this;
    }

    /**
     * Get endemic
     *
     * @return boolean 
     */
    public function getEndemic()
    {
        return $this->endemic;
    }

    /**
     * Set authorInitials
     *
     * @param string $authorInitials
     * @return Taxon
     */
    public function setAuthorInitials($authorInitials)
    {
        $this->authorInitials = $authorInitials;
        return $this;
    }

    /**
     * Get authorInitials
     *
     * @return string 
     */
    public function getAuthorInitials()
    {
        return $this->authorInitials;
    }

    /**
     * Set synonimClasification
     *
     * @param string $synonimClasification
     * @return Taxon
     */
    public function setSynonimClasification($synonimClasification)
    {
        $this->synonimClasification = $synonimClasification;
        return $this;
    }

    /**
     * Get synonimClasification
     *
     * @return string 
     */
    public function getSynonimClasification()
    {
        return $this->synonimClasification;
    }

    /**
     * Set creationDate
     *
     * @param datetime $creationDate
     * @return Taxon
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
     * @return Taxon
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
     * @return Taxon
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
     * Set modificationComments
     *
     * @param text $modificationComments
     * @return Taxon
     */
    public function setModificationComments($modificationComments)
    {
        $this->modificationComments = $modificationComments;
        return $this;
    }

    /**
     * Get modificationComments
     *
     * @return text 
     */
    public function getModificationComments()
    {
        return $this->modificationComments;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Taxon
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
     * Add children_rank
     *
     * @param models\Taxon $childrenRank
     * @return Taxon
     */
    public function addTaxon(\models\Taxon $childrenRank)
    {
        $this->children_rank[] = $childrenRank;
        return $this;
    }

    /**
     * Get children_rank
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildrenRank()
    {
        return $this->children_rank;
    }

    /**
     * Get children_synonyms
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildrenSynonyms()
    {
        return $this->children_synonyms;
    }

    /**
     * Set rank
     *
     * @param models\Rank $rank
     * @return Taxon
     */
    public function setRank(\models\Rank $rank = null)
    {
        $this->rank = $rank;
        return $this;
    }

    /**
     * Get rank
     *
     * @return models\Rank 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set parent_rank
     *
     * @param models\Taxon $parentRank
     * @return Taxon
     */
    public function setParentRank(\models\Taxon $parentRank = null)
    {
        $this->parent_rank = $parentRank;
        return $this;
    }

    /**
     * Get parent_rank
     *
     * @return models\Taxon 
     */
    public function getParentRank()
    {
        return $this->parent_rank;
    }

    /**
     * Set parent_synonyms
     *
     * @param models\Taxon $parentSynonyms
     * @return Taxon
     */
    public function setParentSynonyms(\models\Taxon $parentSynonyms = null)
    {
        $this->parent_synonyms = $parentSynonyms;
        return $this;
    }

    /**
     * Get parent_synonyms
     *
     * @return models\Taxon 
     */
    public function getParentSynonyms()
    {
        return $this->parent_synonyms;
    }

    /**
     * Add authors
     *
     * @param models\Autor $authors
     * @return Taxon
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

    /**
     * Add publications
     *
     * @param models\Publicacion $publications
     * @return Taxon
     */
    public function addPublicacion(\models\Publicacion $publications)
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
     * Add sustratos
     *
     * @param models\Sustrato $sustratos
     * @return Taxon
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