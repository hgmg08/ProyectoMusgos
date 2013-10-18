<?php

class Taxon extends CI_Controller {

	//EntityManager
	private $em;
	
	//Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$auth = $this->session->userdata('auth');
		if ($auth) {
			$user= $this->em->find('entities\User', $this->session->userdata('uid'));
			
			$this->twiggy->set('role', $user->getRole()->getName());
			$this->twiggy->set('username', $user->getUsername());
			$this->twiggy->set('taxons', json_encode($this->populate_grid()));
			
			$this->twiggy->title('Musgos de Venezuela | Panel administración');
			$this->twiggy->template('admin/Taxon/taxon')->display();
		}
		else {
			redirect('');
		}
	}

	public function taxon_form($rank, $taxon_id = NULL)
	{
		$taxon = NULL;
		if ($taxon_id) {
			$taxon = $this->em->find('entities\Taxon', $taxon_id);
			if ($taxon->getRank() < 6) {
				$this->higher_taxa_form($rank, $taxon);
			}
			else {
				$this->lower_taxa_form($rank, $taxon);
			}	
		}
		else {
			if ($rank < 6) {
				$this->higher_taxa_form($rank);
			}
			else {
				$this->lower_taxa_form($rank);
			}	
		}
	}
	
	//Persist higher taxa
	public function persist_higher()
	{
		$id = $this->input->post("id");
		$taxonName = trim($this->input->post("name"));
		$parentId = $this->input->post("parent");
		$rank = $this->input->post("type");
		$operation = $this->input->post("operation");
		
		if ($operation == 1) {
			$taxon = $this->em->find('entities\Taxon', $id);
			$taxon->setName($taxonName);
			$taxon->setParentHierarchy($this->em->find('entities\Taxon', $parentId));
			$this->em->persist($taxon);
			$this->em->flush();
			echo true;
		}
		
		elseif ($operation == 2) {
			$taxon = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $taxonName));
			
			if ($taxon == NULL) {
				$taxon = new entities\Taxon;
				$taxon->setName($taxonName);
				$taxon->setRank($rank);
				$taxon->setParentHierarchy($this->em->find('entities\Taxon', $parentId));
				$taxon->setCreationDate(new \DateTime("now"));
				$taxon->setStatus(2);
				$this->em->persist($taxon);
				$this->em->flush();
				echo true;
			}
			
			else {
				echo false;
			}
		}
		
		else {
			echo false;
		}
	}

	public function persist_lower_details()
	{
		
	}
	
	//Populate higher taxa form
	private function higher_taxa_form($rank, $taxon = NULL) 
	{
		$this->twiggy->set('taxon', $taxon);
		if ($taxon) {
			$this->twiggy->set('parentRank', $this->getParentRankName($taxon->getRank()));
			$this->twiggy->set('parentRankList', 
				json_encode($this->em->getRepository("entities\Taxon")->getAllParentTaxon($this->getParentRankEnum($taxon->getRank()))));
			$this->twiggy->set('rankName', $this->getRankName($taxon->getRank()));
			$this->twiggy->set('rankNumber', $taxon->getRank());
			$this->twiggy->set('operation', 1);
			$this->twiggy->set('id', $taxon->getId());
		}
		else {
			$this->twiggy->set('parentRank', $this->getParentRankName($rank));
			$this->twiggy->set('parentRankList', json_encode($this->em->getRepository("entities\Taxon")->getAllParentTaxon($this->getParentRankEnum($rank))));
			$this->twiggy->set('rank', $this->getRankName($rank));
			$this->twiggy->set('rankNumber', $rank);
			$this->twiggy->set('operation', 2);
			$this->twiggy->set('id', -1);
		}
		$auth = $this->session->userdata('auth');
		if ($auth) {
			$user= $this->em->find('entities\User', $this->session->userdata('uid'));
			
			$this->twiggy->set('role', $user->getRole()->getName());
			$this->twiggy->set('username', $user->getUsername());
			$this->twiggy->title('Musgos de Venezuela | Nuevo taxón');
			$this->twiggy->template('admin/Taxon/taxon_higher')->display();
		}
		else {
			redirect('');
		}
	}
	
	private function lower_taxa_form($rank, $taxon = NULL) 
	{
		$this->twiggy->set('taxon', $taxon);
		
		if ($taxon) {
			$this->twiggy->set('id', $taxon->getId());
			$this->twiggy->set('operation', 1);
			
			$this->twiggy->set('rank', $this->getRankName($taxon->getRank()));
			$this->twiggy->set('rankName', $this->getRankName($taxon->getRank()));
			$this->twiggy->set('parentRank', $this->getParentRankName($taxon->getRank()));
			$this->twiggy->set('parentRankList', json_encode($this->em->getRepository("entities\Taxon")->getAllParentTaxon($this->getParentRankEnum($taxon->getRank()))));
			
			$this->twiggy->set('tax_ecorreg', json_encode($this->fillEcorregiones($taxon)));	
			$this->twiggy->set('tax_sustratos', json_encode($this->fillSustratos($taxon)));
			$this->twiggy->set('tax_ecosistemas', json_encode($this->fillEcosistemas($taxon)));
		}
		
		else {
			$this->twiggy->set('id', 0);
			$this->twiggy->set('operation', 2);
			
			$this->twiggy->set('rank', $this->getRankName($rank));
			$this->twiggy->set('rankName', $this->getRankName($rank));
			$this->twiggy->set('parentRank', $this->getParentRankName($rank));
			$this->twiggy->set('parentRankList', json_encode($this->em->getRepository("entities\Taxon")->getAllParentTaxon($this->getParentRankEnum($rank))));
			
		}

		$this->twiggy->set('lista_roja', json_encode($this->fillListaRoja($taxon)));
		$this->twiggy->set('indicadoresCC', json_encode(NULL));
		$this->twiggy->set('sinonimos', json_encode($this->fillSinonimos($taxon)));
		$this->twiggy->set('especimenes', json_encode($this->fillLocalidades($taxon)));
		
		$this->twiggy->set('sustratos', $this->getSustratos());
		$this->twiggy->set('ecorregiones', json_encode($this->em->getRepository('entities\Ecorregion')->getAll()));
		$this->twiggy->set('ecosistemas', $this->getEcosistemas());
		$this->twiggy->set('estados', json_encode($this->em->getRepository('entities\Estado')->getAll()));	
		
		$auth = $this->session->userdata('auth');
		if ($auth) {
			$user= $this->em->find('entities\User', $this->session->userdata('uid'));
			
			$this->twiggy->set('role', $user->getRole()->getName());
			$this->twiggy->set('username', $user->getUsername());
			$this->twiggy->title('Musgos de Venezuela | Nuevo taxón');
			$this->twiggy->template('admin/Taxon/taxon_lower')->display();
		}
		else {
			redirect('');
		}
	}

	private function fillListaRoja($taxon)
	{
		$listaRoja = NULL;
		if ($taxon) {
			$lista = $taxon->getListasRojas();
			foreach ($lista as $lr) {
				if ($lr) {
					$listaRoja[] = array(
						'id' => $lr->getId(),
						'category' => $lr->getCategory(),
						'criterion' => $lr->getCriterionIUCN(),
						'country' => $lr->getCountry(),
						'author' => $lr->getAuthor()
					);
				}
			}
		}
		return $listaRoja;
	}
	
	private function fillSinonimos($taxon)
	{
		$sinonimos = NULL;
		if ($taxon) {
			$sin = $taxon->getChildrenSynonyms();
			foreach ($sin as $s) {
				$sinonimos[] = array(
					'id' => $s->getId(),
					'name' => $s->getName(),
					'author' => $s->getAuthorInitials(),
					'rank' => $this->getRankName($s->getRank()),
					'type' => $this->getSynonimTypeName($s->getSynonimClasification())
				);
			}
		}
		return $sinonimos;
	}
	
	private function fillLocalidades($taxon)
	{
		$localidades = NULL;
		$loc_pub = NULL;
		
		if ($taxon) {
			$loc = $taxon->getLocalidades();
			foreach ($loc as $l) {
				if ($l->getEstado()) {
					foreach ($l->getPublications() as $p) {
						$loc_pub[] = $p->getQuote();
					}
				}
				
				$localidades[] = array(
					'id' => $l->getId(),
					'state' => ($l->getEstado())? $l->getEstado()->getName() : NULL,
					'town' => ($l->getMunicipio())? $l->getMunicipio()->getName() : NULL,
					'location' => $l->getName(),
					'altitude_min' => $l->getMinAltitude(),
					'altitude_max' => $l->getMaxAltitude(),
					'latitude' => $l->getLatitude(),
					'longitude' => $l->getLongitude(),
					'collection' => $l->getCollection(),
					'collection_date' => ($l->getCollectionDate())? $l->getCollectionDate()->format('d/m/Y') : NULL,
					'herbarium' => $l->getHebarium()
				);
			}
		}
		
		return $localidades;
	}
	
	private function fillSustratos($taxon)
	{
		$sustratos = array();
		$sus = $taxon->getSustratos();
		foreach ($sus as $s) {
			$sustratos[] = $s->getId();
		}
		return $sustratos;
	}
	
	private function fillEcosistemas($taxon)
	{
		$ecosistemas = array();
		$eco = $taxon->getEcosistemas();
		foreach ($eco as $e) {
			$ecosistemas[] = $e->getId();
		}
		return $ecosistemas;
	}
		
	private function fillEcorregiones($taxon) 
	{
		$ecorreg = array();
		$ecor = $taxon->getEcorregiones();
		foreach ($ecor as $er) {
			$ecorreg[] = $er->getId();
		}
		return $ecorreg;
	}

	public function getTowns()
	{
		$state = $this->em->getRepository('entities\Estado')->findOneBy(array('name' => $this->input->get("state")));
		$towns = $this->em->getRepository('entities\Municipio')->getAllByState($state->getId());
		echo json_encode($towns);
	}
	
	private function getSustratos()
	{
		$sust = $this->em->getRepository('entities\Sustrato')->getAll();
		$sustratos = array();
		$i = 0;
		foreach ($sust as $s) {
			$sustratos[$i]['id'] = $s->getId();
			if ($s->getParent()) {
				$sustratos[$i]['parentid'] = $s->getParent()->getId();
			}
			else {
				$sustratos[$i]['parentid'] = -1;
			}
			$sustratos[$i]['text'] = $s->getName();
			$i++;
		}
		
		return json_encode($sustratos);
	}
	
	private function getEcosistemas()
	{
		$eco = $this->em->getRepository('entities\Ecosistema')->getAll();
		$ecosistemas = array();
		$i = 0;
		foreach ($eco as $e) {
			$ecosistemas[$i]['id'] = $e->getId();
			if ($e->getParent()) {
				$ecosistemas[$i]['parentid'] = $e->getParent()->getId();
			}
			else {
				$ecosistemas[$i]['parentid'] = -1;
			}
			$ecosistemas[$i]['text'] = $e->getName();
			$i++;
		}
		
		return json_encode($ecosistemas);
	}
	
	//Populate taxa grid
	private function populate_grid()
	{
		$result = $this->em->getRepository("entities\Taxon")->getAll();
		$taxons = array();
		
		foreach ($result as $r) {
			$taxons[] = array(
				'id' => $r['id'],
				'Name' => $r['name'],
				'Author' => $r['authorInitials'],
				'Rank' => $this->getRankName($r['rank']),
				'RankEnum' => $r['rank']
			);
		}
		
		return $taxons;
	}
	
	//Get Rank Name
	private function getRankName($rankNumber)
	{
		$rankName = "";
		switch ($rankNumber) {
			case 0:
				$rankName = "División";
				break;
			case 1:
				$rankName = "Clase";
				break;
			case 2:
				$rankName = "SubClase";
				break;
			case 3:
				$rankName = "Orden";
				break;
			case 4:
				$rankName = "Familia";
				break;
			case 5:
				$rankName = "Género";
				break;
			case 6:
				$rankName = "Especie";
				break;
			case 7:
				$rankName = "SubEspecie";
				break;
			case 8:
				$rankName = "Variedad";
				break;
			default:
				$rankName = "Sin tipo";
				break;
		}
		return $rankName;
	}
	
	//Get parent Rank Name
	private function getParentRankName($rankNumber)
	{
		$parentRankName = "";
		switch ($rankNumber) {
			//División
			case 0:
				$parentRankName = NULL;
				break;
			//Clase
			case 1:
				$parentRankName = "División";
				break;
			//SubClase
			case 2:
				$parentRankName = "Clase";
				break;
			//Orden
			case 3:
				$parentRankName = "SubClase";
				break;
			//Familia
			case 4:
				$parentRankName = "Orden";
				break;
			//Género
			case 5:
				$parentRankName = "Familia";
				break;
			//Especie
			case 6:
				$parentRankName = "Género";
				break;
			//SubEspecie
			case 7:
				$parentRankName = "Especie";
				break;
			//Especie
			case 8:
				$parentRankName = "Especie";
				break;
			//Sin tipo
			default:
				$parentRankName = "Sin tipo";
				break;
		}
		return $parentRankName;
	}
	
	//Get Parent rank enum
	private function getParentRankEnum($rankNumber)
	{
		$parentRankName = "";
		switch ($rankNumber) {
			//División
			case 0:
				$parentRankName = NULL;
				break;
			//Clase
			case 1:
				$parentRankName = 0;
				break;
			//SubClase
			case 2:
				$parentRankName = 1;
				break;
			//Orden
			case 3:
				$parentRankName = 2;
				break;
			//Familia
			case 4:
				$parentRankName = 3;
				break;
			//Género
			case 5:
				$parentRankName = 4;
				break;
			//Especie
			case 6:
				$parentRankName = 5;
				break;
			//SubEspecie
			case 7:
				$parentRankName = 6;
				break;
			//Especie
			case 8:
				$parentRankName = 6;
				break;
			//Sin tipo
			default:
				$parentRankName = NULL;
				break;
		}
		return $parentRankName;
	}
	
	private function getSynonimTypeName($type) 
	{
		$typeName = "";
		switch ($type) {
			case 1:
				$typeName = "Sinónimo";
				break;
			case 2:
				$typeName = "Basiónimo";
				break;
		}
		return $typeName;
	}
}

?>