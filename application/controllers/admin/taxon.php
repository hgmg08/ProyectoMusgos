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
		$this->twiggy->title('Musgos de Venezuela | Nuevo taxón');
		$this->twiggy->template('admin/Taxon/taxon_higher')->display();
	}
	
	private function lower_taxa_form($rank, $taxon = NULL) 
	{
		$this->twiggy->set('sustratos', $this->getSustratos());
		$this->twiggy->set('ecosistemas', $this->getEcosistemas());
		$this->twiggy->set('sinonimos', json_encode(NULL));
		$this->twiggy->title('Musgos de Venezuela | Nuevo taxón');
		$this->twiggy->template('admin/Taxon/taxon_lower')->display();
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
}

?>