<?php

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['view'] = 'Home/main';
		$data['params'] = "";
		$this->load->view('layout', $data);
	}

}

?>
