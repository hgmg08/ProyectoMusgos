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
		$this->twiggy->set('slides', $this->getRandomImages());
		$this->twiggy->set('rankCount', $this->getRankCount());
		$this->twiggy->title('Musgos de Venezuela');
		$this->twiggy->template('main/index')->display();
	}
	
	private function getRandomImages()
	{
		$taxons = $this->em->getRepository("entities\Taxon")->getTaxonWithImages();
		$images = array();
		$taxonCount = count($taxons);
		
		for ($i=0; $i < 8; $i++) {
			$r = rand(0, $taxonCount); 
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
