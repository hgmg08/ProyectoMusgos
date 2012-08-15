<?php

class Taxon extends CI_Controller {

	//EntityManager
	public $em;
	
	//Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->em = $this->doctrine->em;
	}
	
	//Method remaping
	public function _remap($method)
	{
		$param_offset = 2;
		
		if (!method_exists($this, $method)) {
			$param_offset = 1;
			$method = 'index';
		}
		
		$params = array_slice($this->uri->rsegment_array(), $param_offset);
		call_user_func_array(array($this, $method), $params);
	}  
	
	//Index
	public function index($taxon_id = NULL)
	{
		if(is_numeric($taxon_id)) {
			$this->taxon_details($taxon_id);
		}
		else {
			$data['view'] = 'Taxon/main';
			$this->load->view('layout', $data);
		}
	}
	
	//Taxon details
	public function taxon_details($taxon_id) 
	{
		$taxon = new entities\Taxon;
		$taxon = $this->em->find('entities\Taxon', $taxon_id);
		if($taxon != NULL) {
			$data['params'] = $taxon;
			$data['view'] = 'Taxon/name';
			$this->load->view('layout', $data);
		}
		else {
			$data['view'] = 'Taxon/main';
			$this->load->view('layout', $data);
		}
	}
}

?>
