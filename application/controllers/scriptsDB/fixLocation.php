<?php

class FixLocation extends CI_Controller {
		
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$filePath = './csv/test.csv';
		$data = $this->csvreader->parse_file($filePath);

		foreach ($data as $row) {
			if ($row['localidad'] != "") {
				$location = $this->em->getRepository('entities\Localidad')->findOneBy(array('name' => $row['localidad']));
				
				if ($location) {
					$estado = $taxon = $this->em->find('entities\Estado', 6);
					$location->setEstado($estado);
					$this->em->persist($location);
					$this->em->flush();
				}
			}

			else {
				echo $row['localidad'] . '<br/>';
			}
		}

	}
}
?>