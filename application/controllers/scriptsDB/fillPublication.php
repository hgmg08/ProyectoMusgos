<?php

class FillPublication extends CI_Controller {
	
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$filePath = './csv/publicaciones.csv';
		$data = $this->csvreader->parse_file($filePath);

		foreach ($data as $row) {
			$publication = new entities\Publicacion;
			$publication->setAuthor(utf8_encode($row['autor']));
			$publication->setYear(utf8_encode($row['anyo']));
			$publication->setTitle(utf8_encode($row['titulo']));
			$publication->setJournal(utf8_encode($row['revista']));
			$publication->setCollation(utf8_encode($row['colacion']));
			$publication->setType(utf8_encode($row['tipo']));
			$publication->setQuote(utf8_encode($row['cita_corta']));
			$this->em->persist($publication);
			$this->em->flush();
		}
	}

}

?>
