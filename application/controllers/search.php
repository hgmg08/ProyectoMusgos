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
	
	public function advanced_search()
	{
		$auth = $this->session->userdata('auth');
		if ($auth) {
			$this->twiggy->set('uid', $this->session->userdata('uid'));
		}
		
		$this->twiggy->set('familia', json_encode($this->em->getRepository("entities\Taxon")->getAllByRank(4)));
		$this->twiggy->set('ecosistema', json_encode($this->em->getRepository("entities\Ecosistema")->getAllChildren()));
		$this->twiggy->set('ecorregion', json_encode($this->em->getRepository("entities\Ecorregion")->getAll()));
		$this->twiggy->set('sustrato', json_encode($this->em->getRepository("entities\Sustrato")->getAllChildren()));
		$this->twiggy->set('estado', json_encode($this->em->getRepository("entities\Estado")->getAll()));
		$this->twiggy->title('Musgos de Venezuela')->append("Búsqueda avanzada");
		$this->twiggy->template('main/search_advanced')->display();
	}

	public function advanced()
	{
		$filters = array();
		foreach ($this->input->post() as $key => $value) {
			$filters[$key] = trim($value);
		}
		
		$result = $this->em->getRepository("entities\Taxon")->advancedSearch($filters);
		$taxons = array();
		
		foreach ($result as $r) {
			$taxons[] = array(
				'id' => $r['id'],
				'Name' => $r['name'],
				'Author' => $r['authorInitials'],
				'Accepted' => ($r['acceptedName'] == TRUE)? "!" : ""
			);
		}
		
		$this->twiggy->set('results', json_encode($taxons));
		$this->twiggy->set('search', '-1');
			
		$this->twiggy->title('Musgos de Venezuela')->append('Busqueda');
		$this->twiggy->template('main/search_results')->display();
	}
}
   
?>