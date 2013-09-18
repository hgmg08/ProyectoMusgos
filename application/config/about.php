<?php

class About extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->twiggy->title('Musgos de Venezuela')->append("Acerca de");
		$this->twiggy->template('main/about')->display();
	}
}

?>
