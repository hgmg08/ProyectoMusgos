<?php

class Mdv extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->twiggy->title('Musgos de Venezuela')->append("¿Qué es MdV?");
		$this->twiggy->template('main/mdv')->display();
	}
	
	public function objectives()
	{
		$this->twiggy->title('Musgos de Venezuela')->append("Objetivos");
		$this->twiggy->template('main/mdv_objetivos')->display();
	}
}

?>
