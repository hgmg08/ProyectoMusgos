<?php

class CheckDirImage extends CI_Controller {
		
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$gallery = './public/images/gallery/';
		$taxons = $this->em->getRepository("entities\Taxon")->getAllSpecies();
		
		foreach ($taxons as $t) {
			$dir = $gallery . $t->getId() . "/";
			$imgFiles = glob($dir . "*.jpg");
			if ($imgFiles) {
				$t->setImageDir("Y");
				$this->em->persist($t);
				$this->em->flush();
			}
		}

	}
}
?>