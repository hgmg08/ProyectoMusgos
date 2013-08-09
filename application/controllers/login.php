<?php

class Login extends CI_Controller {

	//EntityManager
	private $em;
	
	//Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('encrypt');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$username = $this->input->post('user');
		$password = $this->input->post('password');
		$password = $this->encrypt->sha1($password);
		
		//Buscar usuario
		$user = $this->em->getRepository('entities\User')->findOneBy(array('username' => $username));
		//Autenticar usuario
		if ($user != NULL) {
			if ($password == $user->getPassword()) {
				//Crear sesion
				$sessData = array(
					'user' => $user->getUsername(),
					'auth' => true
				);
				
				$this->session->set_userdata($sessData);
				redirect('admin/home');
			}
			else {
				redirect('');
			}
		}
		else {
			redirect('');
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}

?>