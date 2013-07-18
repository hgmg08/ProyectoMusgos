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
		$result = new entities\Taxon;
		
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
}
   
?>