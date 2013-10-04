<?php

class User extends CI_Controller {

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
			$this->twiggy->set('users', json_encode($this->populate_grid()));
			$this->twiggy->set('roles', json_encode($this->em->getRepository("entities\Role")->getAll()));
			$this->twiggy->title('Musgos de Venezuela | Panel administración');
			$this->twiggy->template('admin/users')->display();	
		}
		else {
			redirect('');
		}
	}
	
	private function populate_grid()
	{
		$result = $this->em->getRepository("entities\User")->getAll();
		$users = array();

		foreach ($result as $r) {
			$users[] = array(
				'id' => $r['id'],
				'User' => $r['username'],
				'Name' => $r['name'],
				'Email' => $r['email']
			);
		}
		
		return $users;
	}
}

?>