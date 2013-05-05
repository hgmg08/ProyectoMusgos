<?php

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->twiggy->title('Musgos de Venezuela');
		$this->twiggy->template('main/index')->display();
	}
}

?>
