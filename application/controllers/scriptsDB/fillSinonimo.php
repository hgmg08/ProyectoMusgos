<?php
    
class FillSinonimo extends CI_Controller {
	
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$filePath = './csv/sinonimos.csv';
		$data = $this->csvreader->parse_file($filePath);

		foreach ($data as $row) {
			$especie = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => utf8_encode($row['aceptado'])));
			
			if ($especie != NULL) {
				$sinonimo = new entities\Taxon;
				
				$sinonimo->setName(utf8_encode(trim($row['sinonimo'])));
				$sinonimo->setRank($especie->getRank());
				$sinonimo->setSynonimClasification(1);
				$sinonimo->setParentSynonyms($especie);
				$sinonimo->setAuthorInitials(utf8_encode(trim($row['autor'])));
				$sinonimo->setStatus(2);
				$sinonimo->setCreationDate(new \DateTime("now"));
				
				$this->em->persist($sinonimo);
				$this->em->flush();
			}
			
			else {
				echo $row['aceptado'] . '<br />';
			}
		}
	}

}

?>