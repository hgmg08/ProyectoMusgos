<?php

class FillLocation extends CI_Controller {
		
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$filePath = './csv/localidad7.csv';
		$data = $this->csvreader->parse_file($filePath);

		foreach ($data as $row) {
			$especie = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['nombre']));
			
			//Buscar especie
			if ($especie != NULL) {
				
				//Buscar estado
				$state = $this->em-> find('entities\Estado', $row['estado']);

				$localidad = new entities\Localidad;

				//Estado
				$localidad->setEstado($state);

				//Localidad
				$localidad->setName(utf8_encode($row['localidad']));

				//ALtitud
				$altitud_min = ($row['altitud_min'] != "") ? $row['altitud_min'] : NULL;
				$altitud_max = ($row['altitud_max'] != "") ? $row['altitud_max'] : NULL;

				if ($row['altitud_max'] == NULL) {
					$altitud_max = $altitud_min;
				}

				$localidad->setMinAltitude($altitud_min);
				$localidad->setMaxAltitude($altitud_max);

				$localidad->setLatitude(($row['latitud'] != "") ? utf8_encode($row['latitud']) : NULL);
				$localidad->setLongitude(($row['longitud'] != "") ? utf8_encode($row['longitud']) : NULL);
				
				
				$localidad->setCollection(($row['coleccion'] != "") ? utf8_encode($row['coleccion']) : NULL);
				$localidad->setCollectionDate(($row['FechaColeccion'] != "") ? new \DateTime(utf8_encode($row['FechaColeccion'])) : NULL);
				$localidad->setHebarium(($row['herbario'] != "") ? utf8_encode($row['herbario']) : NULL);
				
				if ($row['cita_corta'] != "") {
					$pub = explode('; ', $row['cita_corta']);
					foreach ($pub as $pu) {
						$p = $this->em->getRepository('entities\Publicacion')->findOneBy(array('quote' => utf8_encode($pu)));
						if ($p != NULL) {
							$p->addLocalidad($localidad);
						}
					}
				}
				
				$especie->addLocalidad($localidad);
				$this->em->persist($especie);
				$this->em->flush();
			}

			else {
				echo $row['nombre'] . '<br/>';
			}
		}

	}
}
?>