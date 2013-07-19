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
		$this->twiggy->set('rankCount', $this->getRankCount());
		$this->twiggy->title('Musgos de Venezuela');
		$this->twiggy->template('main/index')->display();
	}
	
	private function getRankCount()
	{
		$rankCount = array();
		$rankCount['clase'] = $this->em->getRepository("entities\Taxon")->rankCount(1);
		$rankCount['subclase']= $this->em->getRepository("entities\Taxon")->rankCount(2);
		$rankCount['orden']= $this->em->getRepository("entities\Taxon")->rankCount(3);
		$rankCount['familia']= $this->em->getRepository("entities\Taxon")->rankCount(4);
		$rankCount['genero']= $this->em->getRepository("entities\Taxon")->rankCount(5);
		$rankCount['especie']= $this->em->getRepository("entities\Taxon")->rankCount(6);
		return $rankCount;
	}
}

?>
