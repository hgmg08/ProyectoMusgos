<?php

class Publication extends CI_Controller {

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
			$this->twiggy->set('publications', json_encode($this->populate_grid()));
			$this->twiggy->title('Musgos de Venezuela | Panel administración');
			$this->twiggy->template('admin/publications')->display();	
		}
		else {
			redirect('');
		}
	}
	
	private function populate_grid()
	{
		$result = $this->em->getRepository("entities\Publicacion")->getAll();
		$publications = array();

		foreach ($result as $r) {
			$publications[] = array(
				'id' => $r['id'],
				'Author' => $r['author'],
				'Title' => $r['title'],
				'Year' => $r['year'],
				'Journal' => $r['journal'],
				'Collation' => $r['collation'],
				'Type' => $r['type'],
				'Quote' => $r['quote']
			);
		}
		
		return $publications;
	}
}

?>