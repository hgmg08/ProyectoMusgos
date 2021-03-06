<?php

namespace repositories;

use Doctrine\ORM\EntityRepository,
	Doctrine\ORM\Query;
	

/**
 * TaxonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaxonRepository extends EntityRepository
{

	public function getAllByStatus($status)
	{
		$query = $this->_em->createQuery(
			"SELECT t FROM entities\Taxon t WHERE t.rank IN(6,7,8) AND t.status = :status"
		);
		$query->setParameter('status', $status);
		return $query->getResult(Query::HYDRATE_ARRAY);
	}
	
	
	/**
	 * Obtener todos los taxones
	 * @return Array de taxones 
	 */
	public function getAll()
	{
		$query = $this->_em->createQuery(
			"SELECT t FROM entities\Taxon t WHERE t.rank > 0 AND t.synonimClasification IS NULL"
		);
		return $query->getResult(Query::HYDRATE_ARRAY);
	}
	
	/**
	 * Busqueda por nombre del Taxon
	 * @param $taxon_name = Nombre del taxon. $exact = Busqueda aproximada o exacta
	 * @return Array de taxones 
	 */
	public function searchTaxonName($taxon_name, $exact = FALSE)
	{
		if ($exact) {
			$query = $this->_em->createQuery(
				"SELECT t FROM entities\Taxon t WHERE CONCAT(t.name, CONCAT(' ', t.authorInitials)) = :name AND t.rank IN(6,7,8) AND t.status = 2 ORDER BY t.name"
			);
			$query->setParameter('name', $taxon_name);
		}
		else {
			$query = $this->_em->createQuery(
				"SELECT t FROM entities\Taxon t WHERE CONCAT(t.name, CONCAT(' ', t.authorInitials)) LIKE :name AND t.rank IN(6,7,8) AND t.status = 2 ORDER BY t.name"
			);
			$query->setParameter('name', "%$taxon_name%");
		}
		return $query->getResult(Query::HYDRATE_ARRAY);
	}
	
	/**
	 * Obtener todos los taxones tengan imágenes
	 * @return Array de objetos tipo taxon
	 */
	public function getTaxonWithImages()
	{
		$query = $this->_em->createQuery(
			"SELECT t FROM entities\Taxon t WHERE t.images = :option"
		);
		$query->setParameter('option', TRUE);
		return $query->getResult(Query::HYDRATE_OBJECT);
	}
	
	/**
	 * Contar los taxones de un rank determinado
	 * @param $rank = Rank del taxón
	 * @return Cantidad de taxones del rank determinado
	 */
	public function rankCount($rank)
	{
		$query = $this->_em->createQuery(
			"SELECT COUNT(t.id) FROM entities\Taxon t WHERE t.rank = :rank AND t.status = 2"
		);
		$query->setParameter('rank', $rank);
		return $query->getResult(Query::HYDRATE_SINGLE_SCALAR);
	}
	
	public function getAllByRank($rank)
	{
		$query = $this->_em->createQuery(
			"SELECT t FROM entities\Taxon t WHERE t.rank = :rank AND t.status = 2"
		);
		$query->setParameter('rank', $rank);
		return $query->getResult(Query::HYDRATE_ARRAY);
	}
	
	public function getAllParentTaxon($parentRank)
	{
		$query = $this->_em->createQuery(
			"SELECT t.id, t.name FROM entities\Taxon t WHERE t.rank = :rank ORDER BY t.name"
		);
		$query->setParameter('rank', $parentRank);
		return $query->getResult(Query::HYDRATE_ARRAY);
	}
	
	public function advancedSearch($filters)
	{	
		$strDql = "SELECT t FROM entities\Taxon t";
		
		if(!empty($filters['genus'])) {
			$strDql = $strDql . " JOIN t.parent_hierarchy ph";
		}
		
		if(empty($filters['genus']) AND !empty($filters['family'])) {
			$strDql = $strDql . " JOIN t.parent_hierarchy ph";
		}
		
		if(!empty($filters['family'])) {
			$strDql = $strDql . " JOIN ph.parent_hierarchy phf";
		}
		
		if(!empty($filters['ecorregion'])) {
			$strDql = $strDql . " JOIN t.ecorregiones ecor";
		}
	
		if(!empty($filters['ecosistema'])) {
			$strDql = $strDql . " JOIN t.ecosistemas ecos";
		}

		if(!empty($filters['sustrato'])) {
			$strDql = $strDql . " JOIN t.sustratos sus";
		}
		
		if(!empty($filters['lr_categ']) || !empty($filters['lr_crite']) || !empty($filters['lr_country']) || 
			!empty($filters['lr_author'])) {
			$strDql = $strDql . " JOIN t.listas_rojas lr";
		}
		
		if(!empty($filters['lr_author'])) {
			$strDql = $strDql . " JOIN lr.publications lrp";
		}
		
		if(!empty($filters['author_pub']) || !empty($filters['title_pub']) || !empty($filters['year_pub']) ||
			!empty($filters['location']) || !empty($filters['estado']) || !empty($filters['min_alt']) || 
			!empty($filters['max_alt']) || !empty($filters['collection']) || $filters['coll_date'] != "/  /"
			|| !empty($filters['herbarium'])) {
			$strDql = $strDql . " JOIN t.localidades loc";
		}
		
		if(!empty($filters['author_pub']) || !empty($filters['title_pub']) || !empty($filters['year_pub'])) {
			$strDql = $strDql . " JOIN loc.publications pub";
		}
		
		if(!empty($filters['estado'])) {
			$strDql = $strDql . " JOIN loc.estado est";
		}
		
		if(!empty($filters['municipio'])) {
			$strDql = $strDql . " JOIN loc.municipio mun";
		}
			
		$strDql = $strDql . " WHERE t.rank IN(6,7,8) AND t.status = 2";
		
		if(!empty($filters['genus'])) {
			$strDql = $strDql . " AND ph.name LIKE :genus";
		}
		
		if(empty($filters['genus']) AND !empty($filters['family'])) {
			$strDql = $strDql . " AND ph.name LIKE :genus";
		}
		
		if(!empty($filters['family'])) {
			$strDql = $strDql . " AND phf.id = :family";
		}
		
		if(!empty($filters['lr_categ'])) {
			$strDql = $strDql . " AND lr.category = :lr_categ";
		}
		
		if(!empty($filters['lr_crite'])) {
			$strDql = $strDql . " AND lr.criterionIUCN = :lr_crite";
		}
		
		if(!empty($filters['lr_country'])) {
			$strDql = $strDql . " AND lr.country = :lr_country";
		}
		
		if(!empty($filters['lr_author'])) {
			$strDql = $strDql . " AND lrp.quote LIKE :lr_author";
		}
		
		if(!empty($filters['name_tax'])) {
			$strDql = $strDql . " AND t.name LIKE :name_tax";
		}
		
		if(!empty($filters['author_tax'])) {
			$strDql = $strDql . " AND t.authorInitials LIKE :author_tax";
		}
		
		if(!empty($filters['zona_vdw'])) {
			$strDql = $strDql . " AND t.VDWDistribution LIKE :zona_vdw";
		}
		
		if(!empty($filters['andean'])) {
			$strDql = $strDql . " AND t.tropicalAndeanDistribution LIKE :andean";
		}
		
		if(!empty($filters['endemism'])) {
			$strDql = $strDql . " AND t.endemic = :endemism";
		}
		
		if(!empty($filters['ecorregion'])) {
			$strDql = $strDql . " AND ecor.id = :ecorregion";
		}

		if(!empty($filters['ecosistema'])) {
			$strDql = $strDql . " AND ecos.id = :ecosistema";
		}
		
		if(!empty($filters['sustrato'])) {
			$strDql = $strDql . " AND sus.id = :sustrato";
		}
		
		if(!empty($filters['author_pub'])) {
			$strDql = $strDql . " AND pub.author LIKE :author_pub";
		}
		
		if(!empty($filters['title_pub'])) {
			$strDql = $strDql . " AND pub.title LIKE :title_pub";
		}
		
		if(!empty($filters['year_pub'])) {
			$strDql = $strDql . " AND pub.year = :year_pub";
		}
		
		if(!empty($filters['collection'])) {
			$strDql = $strDql . " AND loc.collection LIKE :collection";
		}
		
		if($filters['coll_date'] != "/  /") {
			$strDql = $strDql . " AND loc.collectionDate = :coll_date";
		}
		
		if(!empty($filters['herbarium'])) {
			$strDql = $strDql . " AND loc.hebarium LIKE :herbarium";
		}
		
		if(!empty($filters['location'])) {
			$strDql = $strDql . " AND loc.name LIKE :location";
		}
		
		if($filters['min_alt'] != "") {
			$strDql = $strDql . " AND loc.minAltitude >= :minAlt";
		}
		
		if($filters['max_alt'] != "") {
			$strDql = $strDql . " AND loc.maxAltitude <=  :maxAlt";
		}
		
		if(!empty($filters['estado'])) {
			$strDql = $strDql . " AND est.id = :estado";
		}
		
		if(!empty($filters['municipio'])) {
			$strDql = $strDql . " AND mun.id = :municipio";
		}
		
		$strDql = $strDql . " GROUP BY t.id ORDER BY t.name";
		
		$query = $this->_em->createQuery($strDql);
		
		if(!empty($filters['genus'])) {
			$query->setParameter('genus', "%".$filters['genus']."%");
		}
		
		if(empty($filters['genus']) AND !empty($filters['family'])) {
			$query->setParameter('genus', "%");
		}
		
		if(!empty($filters['family'])) {
			$query->setParameter('family', $filters['family']);
		}
		
		if(!empty($filters['lr_categ'])) {
			$query->setParameter('lr_categ', $filters['lr_categ']);
		}
		
		if(!empty($filters['lr_crite'])) {
			$query->setParameter('lr_crite', $filters['lr_crite']);
		}
		
		if(!empty($filters['lr_country'])) {
			$query->setParameter('lr_country', $filters['lr_country']);
		}
		
		if(!empty($filters['lr_author'])) {
			$query->setParameter('lr_author', "%".$filters['lr_author']."%");
		}
		
		if(!empty($filters['name_tax'])) {
			$query->setParameter('name_tax', "%".$filters['name_tax']."%");
		}
		
		if(!empty($filters['author_tax'])) {
			$query->setParameter('author_tax', "%".$filters['author_tax']."%");
		}
		
		if(!empty($filters['zona_vdw'])) {
			$query->setParameter('zona_vdw', "%".$filters['zona_vdw']."%");
		}
		
		if(!empty($filters['andean'])) {
			$query->setParameter('andean', "%".$filters['andean']."%");
		}
		
		if(!empty($filters['endemism'])) {
			$query->setParameter('endemism', $filters['endemism']);
		}

		if(!empty($filters['ecorregion'])) {
			$query->setParameter('ecorregion', $filters['ecorregion']);
		}
		
		if(!empty($filters['ecosistema'])) {
			$query->setParameter('ecosistema', $filters['ecosistema']);
		}
		
		if(!empty($filters['sustrato'])) {
			$query->setParameter('sustrato', $filters['sustrato']);
		}
		
		if(!empty($filters['author_pub'])) {
			$query->setParameter('author_pub', "%".$filters['author_pub']."%");
		}

		if(!empty($filters['title_pub'])) {
			$query->setParameter('title_pub', "%".$filters['title_pub']."%");
		}
		
		if(!empty($filters['year_pub'])) {
			$query->setParameter('year_pub', $filters['year_pub']);
		}
		
		if(!empty($filters['collection'])) {
			$query->setParameter('collection', "%".$filters['collection']."%");
		}
		
		if($filters['coll_date'] != "/  /") {
			$query->setParameter('coll_date', new \DateTime($filters['coll_date']));
		}
		
		if(!empty($filters['herbarium'])) {
			$query->setParameter('herbarium', "%".$filters['herbarium']."%");
		}
		
		if(!empty($filters['location'])) {
			$query->setParameter('location', "%".$filters['location']."%");
		}
		
		if($filters['min_alt'] != "") {
			$query->setParameter('minAlt', $filters['min_alt']);
		}
		
		if($filters['max_alt'] != "") {
			$query->setParameter('maxAlt', $filters['max_alt']);
		}

		if(!empty($filters['estado'])) {
			$query->setParameter('estado', $filters['estado']);
		}
		
		if(!empty($filters['municipio'])) {
			$query->setParameter('municipio', $filters['municipio']);
		}
		
		return $query->getResult(Query::HYDRATE_ARRAY);
	}
	
}