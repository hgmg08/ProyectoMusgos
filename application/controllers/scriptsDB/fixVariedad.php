<?php

class FixVariedad extends CI_Controller {
	
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$filePath = './csv/vari.csv';
		$data = $this->csvreader->parse_file($filePath);

		foreach ($data as $row) {
			$variedad = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['nombre']));
			
			if ($variedad) {
				$parent = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['parent']));
				
				if ($parent) {
					$variedad->setParentHierarchy($parent);
					$this->em->persist($variedad);
					$this->em->flush();
				}
				
				else {
					echo $row['parent'] . "<br/>";
				}
			}
			else {
				echo $row['nombre'] . "<br/>";
			}
		}
	}
}

?>
