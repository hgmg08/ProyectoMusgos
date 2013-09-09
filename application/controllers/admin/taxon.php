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
			$this->twiggy->set('username', $this->session->userdata('user'));
			$this->twiggy->set('taxons', json_encode($this->populate_grid()));
			
			$this->twiggy->title('Musgos de Venezuela | Panel administración');
			$this->twiggy->template('admin/Taxon/taxon')->display();
		}
		else {
			redirect('');
		}
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
				'Rank' => $this->getRankName($r['rank'])
			);
		}
		
		return $taxons;
	}
	
	private function getRankName($rankNumber)
	{
		switch ($rankNumber) {
			case 0:
				return "División";
			case 1:
				return "Clase";
			case 2:
				return "SubClase";
			case 3:
				return "Orden";
			case 4:
				return "Familia";
			case 5:
				return "Género";
			case 6:
				return "Especie";
			case 7:
				return "SubEspecie";
			case 8:
				return "Variedad";
			default:
				return "Sin tipo";
		}
	}
}

?>