<?php

class Home extends CI_Controller {

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
			$this->twiggy->title('Musgos de Venezuela | Panel administración');
			$this->twiggy->template('admin/index')->display();	
		}
		else {
			redirect('');
		}
	}
}

?>