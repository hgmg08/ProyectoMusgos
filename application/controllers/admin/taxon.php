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
	
	private function higher_taxa_form($rank, $taxon = NULL) {
		$this->twiggy->set('taxon', $taxon);
		if ($taxon) {
			$this->twiggy->set('parentRank', $this->getParentRankName($taxon->getRank()));
			$this->twiggy->set('parentRankList', 
				json_encode($this->em->getRepository("entities\Taxon")->getAllParentTaxon($this->getParentRankEnum($taxon->getRank()))));
			$this->twiggy->set('rankName', $this->getRankName($taxon->getRank()));
		}
		else {
			$this->twiggy->set('parentRank', $this->getParentRankName($rank));
			$this->twiggy->set('parentRankList', json_encode($this->em->getRepository("entities\Taxon")->getAllParentTaxon($this->getParentRankEnum($rank))));
			$this->twiggy->set('rank', $this->getRankName($rank));	
		}
		$this->twiggy->title('Musgos de Venezuela | Nuevo taxón');
		$this->twiggy->template('admin/Taxon/taxon_higher')->display();
	}
	
	private function lower_taxa_form($action, $taxon = NULL) {
		
	}
	
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