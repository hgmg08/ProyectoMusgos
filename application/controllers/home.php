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
		$auth = $this->session->userdata('auth');
		if ($auth) {
			$this->twiggy->set('username', $this->session->userdata('user'));
		}
		$this->twiggy->set('sustratos', json_encode($this->em->getRepository("entities\Sustrato")->getAll()));
		$this->twiggy->set('ecorregiones', json_encode($ecor = $this->em->getRepository("entities\Ecorregion")->getAll()));
		$this->twiggy->set('ecosistemas', json_encode($this->em->getRepository("entities\Ecosistema")->getAll()));
		$this->twiggy->set('estados', json_encode($this->em->getRepository("entities\Estado")->getAll()));
		$this->twiggy->set('slides', $this->getRandomImages());
		$this->twiggy->set('rankCount', $this->getRankCount());
		$this->twiggy->title('Musgos de Venezuela');
		$this->twiggy->template('main/index')->display();
	}
	
	public function mdv() 
	{
		$this->twiggy->set('sustratos', json_encode($this->em->getRepository("entities\Sustrato")->getAll()));
		$this->twiggy->set('ecorregiones', json_encode($ecor = $this->em->getRepository("entities\Ecorregion")->getAll()));
		$this->twiggy->set('ecosistemas', json_encode($this->em->getRepository("entities\Ecosistema")->getAll()));
		$this->twiggy->set('estados', json_encode($this->em->getRepository("entities\Estado")->getAll()));
		$this->twiggy->title('Musgos de Venezuela')->append("¿Qué es MdV?");
		$this->twiggy->template('main/mdv')->display();
	}
	
	public function objectives()
	{
		$this->twiggy->set('sustratos', json_encode($this->em->getRepository("entities\Sustrato")->getAll()));
		$this->twiggy->set('ecorregiones', json_encode($ecor = $this->em->getRepository("entities\Ecorregion")->getAll()));
		$this->twiggy->set('ecosistemas', json_encode($this->em->getRepository("entities\Ecosistema")->getAll()));
		$this->twiggy->set('estados', json_encode($this->em->getRepository("entities\Estado")->getAll()));
		$this->twiggy->title('Musgos de Venezuela')->append("Objetivos");
		$this->twiggy->template('main/mdv_objetivos')->display();
	}
	
	public function about() {
		$this->twiggy->set('sustratos', json_encode($this->em->getRepository("entities\Sustrato")->getAll()));
		$this->twiggy->set('ecorregiones', json_encode($ecor = $this->em->getRepository("entities\Ecorregion")->getAll()));
		$this->twiggy->set('ecosistemas', json_encode($this->em->getRepository("entities\Ecosistema")->getAll()));
		$this->twiggy->set('estados', json_encode($this->em->getRepository("entities\Estado")->getAll()));
		$this->twiggy->title('Musgos de Venezuela')->append("Acerca de");
		$this->twiggy->template('main/about')->display();
	}
	
	private function getRandomImages()
	{
		$taxons = $this->em->getRepository("entities\Taxon")->getTaxonWithImages();
		$images = array();
		$taxonCount = count($taxons);
		
		for ($i=0; $i < 5; $i++) {
			$r = mt_rand(1, $taxonCount - 1);
			$galleryDir = 'public/images/gallery/' . $taxons[$r]->getId() . '/';
			$imgFiles = glob($galleryDir . "*.jpg");
			foreach ($imgFiles as $img) {
				$images[$i]['id'] = $taxons[$r]->getId();
				$images[$i]['img'] = $img;
				$images[$i]['caption'] = $taxons[$r]->getName();
				break;
			}
		}
		return $images;
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