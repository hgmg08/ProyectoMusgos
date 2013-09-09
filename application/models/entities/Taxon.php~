<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Taxon
 */
class Taxon extends BaseInfo
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
     * @var integer $rank
     */
    private $rank;

    /**
     * @var string $authorInitials
     */
    private $authorInitials;

    /**
     * @var boolean $endemic
     */
    private $endemic;

    /**
     * @var integer $synonimClasification
     */
    private $synonimClasification;

    /**
     * @var text $globalDistribution
     */
    private $globalDistribution;

    /**
     * @var text $tropicalAndeanDistribution
     */
    private $tropicalAndeanDistribution;

    /**
     * @var text $VDWDistribution
     */
    private $VDWDistribution;

    /**
     * @var string $reviewEditor
     */
    private $reviewEditor;

    /**
     * @var datetime $reviewDate
     */
    private $reviewDate;

    /**
     * @var text $reviewComments
     */
    private $reviewComments;

    /**
     * @var string $imageDir
     */
    private $imageDir;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $children_hierarchy;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $children_synonyms;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $notas;

    /**
     * @var entities\Taxon
     */
    private $parent_hierarchy;

    /**
     * @var entities\Taxon
     */
    private $parent_synonyms;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $sustratos;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $ecorregiones;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $ecosistemas;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $cambios_climaticos;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $listas_rojas;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $localidades;

    public function __construct()
    {
        $this->children_hierarchy = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children_synonyms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sustratos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ecorregiones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ecosistemas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cambios_climaticos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->listas_rojas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->localidades = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set rank
     *
     * @param integer $rank
     * @return Taxon
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
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
     * Set synonimClasification
     *
     * @param integer $synonimClasification
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
     * @return integer 
     */
    public function getSynonimClasification()
    {
        return $this->synonimClasification;
    }

    /**
     * Set globalDistribution
     *
     * @param text $globalDistribution
     * @return Taxon
     */
    public function setGlobalDistribution($globalDistribution)
    {
        $this->globalDistribution = $globalDistribution;
        return $this;
    }

    /**
     * Get globalDistribution
     *
     * @return text 
     */
    public function getGlobalDistribution()
    {
        return $this->globalDistribution;
    }

    /**
     * Set tropicalAndeanDistribution
     *
     * @param text $tropicalAndeanDistribution
     * @return Taxon
     */
    public function setTropicalAndeanDistribution($tropicalAndeanDistribution)
    {
        $this->tropicalAndeanDistribution = $tropicalAndeanDistribution;
        return $this;
    }

    /**
     * Get tropicalAndeanDistribution
     *
     * @return text 
     */
    public function getTropicalAndeanDistribution()
    {
        return $this->tropicalAndeanDistribution;
    }

    /**
     * Set VDWDistribution
     *
     * @param text $vDWDistribution
     * @return Taxon
     */
    public function setVDWDistribution($vDWDistribution)
    {
        $this->VDWDistribution = $vDWDistribution;
        return $this;
    }

    /**
     * Get VDWDistribution
     *
     * @return text 
     */
    public function getVDWDistribution()
    {
        return $this->VDWDistribution;
    }

    /**
     * Set reviewEditor
     *
     * @param string $reviewEditor
     * @return Taxon
     */
    public function setReviewEditor($reviewEditor)
    {
        $this->reviewEditor = $reviewEditor;
        return $this;
    }

    /**
     * Get reviewEditor
     *
     * @return string 
     */
    public function getReviewEditor()
    {
        return $this->reviewEditor;
    }

    /**
     * Set reviewDate
     *
     * @param datetime $reviewDate
     * @return Taxon
     */
    public function setReviewDate($reviewDate)
    {
        $this->reviewDate = $reviewDate;
        return $this;
    }

    /**
     * Get reviewDate
     *
     * @return datetime 
     */
    public function getReviewDate()
    {
        return $this->reviewDate;
    }

    /**
     * Set reviewComments
     *
     * @param text $reviewComments
     * @return Taxon
     */
    public function setReviewComments($reviewComments)
    {
        $this->reviewComments = $reviewComments;
        return $this;
    }

    /**
     * Get reviewComments
     *
     * @return text 
     */
    public function getReviewComments()
    {
        return $this->reviewComments;
    }

    /**
     * Set imageDir
     *
     * @param string $imageDir
     * @return Taxon
     */
    public function setImageDir($imageDir)
    {
        $this->imageDir = $imageDir;
        return $this;
    }

    /**
     * Get imageDir
     *
     * @return string 
     */
    public function getImageDir()
    {
        return $this->imageDir;
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
     * Add children_hierarchy
     *
     * @param entities\Taxon $childrenHierarchy
     * @return Taxon
     */
    public function setChildrenHierarchy(\entities\Taxon $childrenHierarchy)
    {
        $this->children_hierarchy[] = $childrenHierarchy;
        return $this;
    }
	
	/**
     * Add children_synonyms
     *
     * @param entities\Taxon $childrenSynonym
     * @return Taxon
     */
    public function setChildrenSynonyms(\entities\Taxon $childrenSynonym)
    {
        $this->children_synonyms[] = $childrenSynonym;
        return $this;
    }

    /**
     * Get children_hierarchy
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildrenHierarchy()
    {
        return $this->children_hierarchy;
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
     * Add notas
     *
     * @param entities\Nota $notas
     * @return Taxon
     */
    public function addNota(\entities\Nota $notas)
    {
        $this->notas[] = $notas;
        return $this;
    }

    /**
     * Get notas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Set parent_hierarchy
     *
     * @param entities\Taxon $parentHierarchy
     * @return Taxon
     */
    public function setParentHierarchy(\entities\Taxon $parentHierarchy = null)
    {
        $this->parent_hierarchy = $parentHierarchy;
        return $this;
    }

    /**
     * Get parent_hierarchy
     *
     * @return entities\Taxon 
     */
    public function getParentHierarchy()
    {
        return $this->parent_hierarchy;
    }

    /**
     * Set parent_synonyms
     *
     * @param entities\Taxon $parentSynonyms
     * @return Taxon
     */
    public function setParentSynonyms(\entities\Taxon $parentSynonyms = null)
    {
        $this->parent_synonyms = $parentSynonyms;
        return $this;
    }

    /**
     * Get parent_synonyms
     *
     * @return entities\Taxon 
     */
    public function getParentSynonyms()
    {
        return $this->parent_synonyms;
    }

    /**
     * Add sustratos
     *
     * @param entities\Sustrato $sustratos
     * @return Taxon
     */
    public function addSustrato(\entities\Sustrato $sustratos)
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

    /**
     * Add ecorregiones
     *
     * @param entities\Ecorregion $ecorregiones
     * @return Taxon
     */
    public function addEcorregion(\entities\Ecorregion $ecorregiones)
    {
        $this->ecorregiones[] = $ecorregiones;
        return $this;
    }

    /**
     * Get ecorregiones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEcorregiones()
    {
        return $this->ecorregiones;
    }

    /**
     * Add ecosistemas
     *
     * @param entities\Ecosistema $ecosistemas
     * @return Taxon
     */
    public function addEcosistema(\entities\Ecosistema $ecosistemas)
    {
        $this->ecosistemas[] = $ecosistemas;
        return $this;
    }

    /**
     * Get ecosistemas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEcosistemas()
    {
        return $this->ecosistemas;
    }

    /**
     * Add cambios_climaticos
     *
     * @param entities\CambioClimatico $cambiosClimaticos
     * @return Taxon
     */
    public function addCambioClimatico(\entities\CambioClimatico $cambiosClimaticos)
    {
        $this->cambios_climaticos[] = $cambiosClimaticos;
        return $this;
    }

    /**
     * Get cambios_climaticos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCambiosClimaticos()
    {
        return $this->cambios_climaticos;
    }

    /**
     * Add listas_rojas
     *
     * @param entities\ListaRoja $listasRojas
     * @return Taxon
     */
    public function addListaRoja(\entities\ListaRoja $listasRojas)
    {
        $this->listas_rojas[] = $listasRojas;
        return $this;
    }

    /**
     * Get listas_rojas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getListasRojas()
    {
        return $this->listas_rojas;
    }

    /**
     * Add localidades
     *
     * @param entities\Localidad $localidades
     * @return Taxon
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

    /**
     * Add children_hierarchy
     *
     * @param entities\Taxon $childrenHierarchy
     * @return Taxon
     */
    public function addSynonym(\entities\Taxon $childrenHierarchy)
    {
        $this->children_hierarchy[] = $childrenHierarchy;
        return $this;
    }

    /**
     * Add children_hierarchy
     *
     * @param entities\Taxon $childrenHierarchy
     * @return Taxon
     */
    public function addTaxon(\entities\Taxon $childrenHierarchy)
    {
        $this->children_hierarchy[] = $childrenHierarchy;
        return $this;
    }
    /**
     * @var boolean $images
     */
    private $images;


    /**
     * Set images
     *
     * @param boolean $images
     * @return Taxon
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * Get images
     *
     * @return boolean 
     */
    public function getImages()
    {
        return $this->images;
    }
}