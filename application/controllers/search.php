<?php
    
class Search extends CI_Controller {
	
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
		$name = $this->input->get('name');
		$results = $this->general_search($name);
		
		$this->twiggy->set('adv_sustratos', json_encode($this->em->getRepository("entities\Sustrato")->getAll()));
		$this->twiggy->set('adv_ecorregiones', json_encode($ecor = $this->em->getRepository("entities\Ecorregion")->getAll()));
		$this->twiggy->set('adv_ecosistemas', json_encode($this->em->getRepository("entities\Ecosistema")->getAll()));
		$this->twiggy->set('adv_estados', json_encode($this->em->getRepository("entities\Estado")->getAll()));
		$this->twiggy->set('results', json_encode($results));
		$this->twiggy->set('search', $name);
			
		$this->twiggy->title('Musgos de Venezuela')->append('Busqueda');
		$this->twiggy->template('main/search_results')->display();
	}

	//Busqueda general
	private function general_search($taxon_name)
	{		
		//Busqueda aproximada
		$result = $this->em->getRepository("entities\Taxon")->searchTaxonName($taxon_name);
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
	
	private function getAllSustratos()
	{
		$sust = $this->em->getRepository("entities\Sustrato")->getAll();
		return json_encode($sust);
	}
}
   
?>