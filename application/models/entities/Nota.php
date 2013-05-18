<?php

namespace entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities\Nota
 */
class Nota
{
    /**
     * @var text $content
     */
    private $content;

    /**
     * @var datetime $creationDate
     */
    private $creationDate;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var entities\Taxon
     */
    private $taxon;


    /**
     * Set content
     *
     * @param text $content
     * @return Nota
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set creationDate
     *
     * @param datetime $creationDate
     * @return Nota
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set taxon
     *
     * @param entities\Taxon $taxon
     * @return Nota
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