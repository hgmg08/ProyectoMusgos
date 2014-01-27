<?php
    
class Tlist extends CI_Controller {
	
	//EntityManager
	private $em;
	
	//Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->em = $this->doctrine->em;
	}
	
	//Index
	public function index()
	{
		$rank = $this->input->get('rank');
		$results = $this->taxon_list($rank);
		
		$this->twiggy->set('results', json_encode($results));
		$this->twiggy->set('rank', $this->getRankName($rank));
			
		$this->twiggy->title('Musgos de Venezuela')->append('Listados');
		$this->twiggy->template('main/list')->display();
	}
	
	public function taxon_list($rank)
	{
		$result = $this->em->getRepository("entities\Taxon")->getAllByRank($rank);
		$taxons = array();
		
		foreach ($result as $r) {
			$taxons[] = array(
				'id' => $r['id'],
				'Name' => $r['name'],
				'Author' => $r['authorInitials'],
				'Accepted' => ($r['acceptedName'] == TRUE)? "!" : ""
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
	
}

?>