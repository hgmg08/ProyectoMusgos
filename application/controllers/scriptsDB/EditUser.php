<?php

class EditUser extends CI_Controller {
		
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->em = $this->doctrine->em;
		$this->load->library('encrypt');
	}

	public function index()
	{
		$user = $this->em->find('entities\User', 1);
		$user->setPassword($this->encrypt->sha1('admin'));
	}
}
?>