<?php

class FillGallery extends CI_Controller {
		
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$filePath = './csv/lista.csv';
		$gallery = './public/images/gallery/';
		$data = $this->csvreader->parse_file($filePath);

		foreach ($data as $row) {
			$especie = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['nombre']));
			
			//Buscar especie
			if ($especie != NULL and $row['Dir'] != '') {
				if (!rename($gallery.$row['Dir'], $gallery.$especie->getId())) {
					echo "fail <br>";
				}
			}

			else {
				echo $row['nombre'] . '<br/>';
			}
		}

	}
}
?>