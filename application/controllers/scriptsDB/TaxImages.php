<?php

class TaxImages extends CI_Controller {
	
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$taxons = $this->em->getRepository("entities\Taxon")->getTaxonWithImages();
		$taxonCount = count($taxons);
		$images = array();
		
		foreach($taxons as $t) {
			$galleryDir = 'public/images/gallery/' . $t->getId() . '/';
			$imgFiles = glob($galleryDir . "*.jpg");
			$imgTextFile = glob($galleryDir . "*.csv");
			$imgTextData = $this->csvreader->parse_file($imgTextFile[0]);
			
			$imgName = str_replace($galleryDir, "", $imgFiles[0]);
			$images[]['id'] = $t->getId();
			$images[]['img'] = $imgFiles[0];
			$images[]['caption'] = $t->getName();
			
			foreach($imgTextData as $data) {
				if ($data['Imagen'] == str_replace(".jpg", "", $imgName)) {
				}
				else {
					echo $t->getName() . $t->getId() . '<br/>';
				}
			}
		}
	}
}

?>
