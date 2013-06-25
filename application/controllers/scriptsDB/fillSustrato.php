<?php

class FillSustrato extends CI_Controller {
	
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$filePath = './csv/especies2.csv';
		$data = $this->csvreader->parse_file($filePath);
		$current = "";
		
		foreach ($data as $row) {
			$last = $current;	
			$current = $row['nombre'];
			
			if ($current != $last) {
				$taxon = $this->em->getRepository("entities\Taxon")->searchTaxonName($row['nombre'], TRUE);
				
				foreach($taxon as $especie) {
						if ($especie != NULL) {
							echo $especie->getName() . "<br/>";
							//Sustrato
							$habito = explode(', ', $row['habito']);
							$sustrato = explode(', ', $row['sustrato']);
							if ($row['sustrato'] != "") {
								foreach ($sustrato as $sus) {
									$s = $this->em->getRepository('entities\Sustrato')->findOneBy(array('name' => utf8_encode($sus)));
									if ($s != NULL) {
										$especie->addSustrato($s);
									}
								}
							}
							else {
								if($row['habito'] != "") {
									foreach ($habito as $hab) {
										echo $hab . "<br />";
										$h = $this->em->getRepository('entities\Sustrato')->findOneBy(array('name' => utf8_encode($hab)));
										if ($h != NULL) {
											$especie->addSustrato($h);
										}
									}
								}
							}
							
							$this->em->persist($especie);
							$this->em->flush();
						}
						
						else {
							echo "Fallido:" . $row['nombre'] . "<br />";
						}
				}
			}
			else {
				echo $current . "<br/>";
			}	
		}
	}
}

?>
