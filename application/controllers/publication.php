<?php

class Publication extends CI_Controller {

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
	public function index($publication_id = NULL)
	{
		if(is_numeric($publication_id)) {
			$this->publication_details($publication_id);
		}
		else {
			$data['view'] = 'Publication/main';
			$this->load->view('layout', $data);
		}
	}
	
	//Taxon details
	public function publication_details($publication_id) 
	{
		$publication = new entities\Publicacion;
		$publication = $this->em->find('entities\Publicacion', $publication_id);
		$data['params'] = $publication;
		$data['view'] = 'Publication/name';
		$this->load->view('layout', $data);
	}
}

?>
