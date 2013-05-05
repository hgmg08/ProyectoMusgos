<?php

class FillTaxon extends CI_Controller {
	
	private $em;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('csvreader');
		$this->em = $this->doctrine->em;
	}

	public function index()
	{
		$filePath = './csv/especies3.csv';
		$data = $this->csvreader->parse_file($filePath);

		foreach ($data as $row) {
			$division = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['division']));
			
			if ($division == NULL and $row['division'] != "") {
				$division = new entities\Taxon;
				$division->setName(utf8_encode($row['division']));
				$division->setRank(0);
				$division->setParentHierarchy(NULL);
				$division->setStatus(2);
				$division->setCreationDate(new \DateTime("now"));
				$this->em->persist($division);
				$this->em->flush();
			}
			
			//Clase
			$clase = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['clase']));
			
			if ($clase == NULL and $row['clase'] != "") {
				$clase = new entities\Taxon;
				$clase->setName(utf8_encode($row['clase']));
				$clase->setRank(1);
				$clase->setParentHierarchy($division);
				$clase->setStatus(2);
				$clase->setCreationDate(new \DateTime("now"));
				$this->em->persist($clase);
				$this->em->flush();
			}
			
			//SubClase
			$subclase = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['subclase']));
			
			if ($subclase == NULL and $row['subclase'] != "") {
				$subclase = new entities\Taxon;
				$subclase->setName(utf8_encode($row['subclase']));
				$subclase->setRank(2);
				$subclase->setParentHierarchy($clase);
				$subclase->setStatus(2);
				$subclase->setCreationDate(new \DateTime("now"));
				$this->em->persist($subclase);
				$this->em->flush();
			}
			
			//Orden
			$orden = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['orden']));
			
			if ($orden == NULL and $row['orden'] != "") {
				$orden = new entities\Taxon;
				$orden->setName(utf8_encode($row['orden']));
				$orden->setRank(3);
				if ($row['subclase'] != "") {
					$orden->setParentHierarchy($subclase);
				}
				else {
					$orden->setParentHierarchy($clase);
				}
				$orden->setStatus(2);
				$orden->setCreationDate(new \DateTime("now"));
				$this->em->persist($orden);
				$this->em->flush();
			}

			//Familia
			$familia = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['familia']));
				
			//Si no existe, agregar
			if ($familia == NULL and $row['familia'] != "") {
				$familia = new entities\Taxon;
				$familia->setName(utf8_encode($row['familia']));
				$familia->setRank(4);
				$familia->setParentHierarchy($orden);
				$familia->setStatus(2);
				$familia->setCreationDate(new \DateTime("now"));
				$this->em->persist($familia);
				$this->em->flush();
			}
			
			//Genero
			$genero = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['genero']));

			//Si no existe, agregar
			if ($genero == NULL and $row['familia'] != "") {
				$genero = new entities\Taxon;
				$genero->setName(utf8_encode($row['genero']));
				$genero->setRank(5);
				$genero->setParentHierarchy($familia);
				$genero->setStatus(2);
				$genero->setCreationDate(new \DateTime("now"));
				$this->em->persist($genero);
				$this->em->flush();
			}

			//Especie
			$especie = $this->em->getRepository('entities\Taxon')->findOneBy(array('name' => $row['nombre']));
			
			if ($especie == NULL) {
				$especie = new entities\Taxon;

				$especie->setParentHierarchy($genero);
	
				//Nombre
				$especie->setName(utf8_encode($row['nombre']));
	
				//Autor
				$especie->setAuthorInitials(utf8_encode($row['autor']));
	
				//Aceptado
				$especie->setAcceptedName($row['aceptado']);
	
				//Rank
				$especie->setRank($row['clasificacion']);
	
				//Endemica
				$especie->setEndemic($row['endemica']);
	
				//Zonas VDW
				$especie->setVDWDistribution(($row['zona_vdw'] != "") ? utf8_encode($row['zona_vdw']) : NULL);
	
				//Andinotropical
				$especie->setTropicalAndeanDistribution(($row['paises_andinotropicales'] != "") ? utf8_encode($row['paises_andinotropicales']) : NULL);
	
				//Mundial
				$especie->setGlobalDistribution(($row['distribucion_mundial'] != "") ? utf8_encode($row['distribucion_mundial']) : NULL);
	
				//Ecorregion
				$ecorregiones = explode(', ', $row['ecorregion']);
				foreach ($ecorregiones as $ecorregion) {
					$ec = $this->em->getRepository('entities\Ecorregion')->findOneBy(array('name' => $ecorregion));
					if ($ec != NULL) {
						$especie->addEcorregion($ec);
					}
				}
	
				//Sustrato
				$habito = explode(', ', $row['habito']);
				$sustrato = explode(' # ', $row['sustrato']);
				foreach ($habito as $hab) {
					$h = $this->em->getRepository('entities\Sustrato')->findOneBy(array('name' => $hab));
					if ($h != NULL) {
						$especie->addSustrato($h);
					}
				}
				foreach ($sustrato as $sus) {
					$s = $this->em->getRepository('entities\Sustrato')->findOneBy(array('name' => $sus));
					if ($s != NULL) {
						$especie->addSustrato($s);
					}
				}
	
				//Lista Roja
				if ($row['Lista Roja mundial'] != "" and $row['CategoriaIUCN'] != "" and
						$row['CriterioIUCN'] != "" and $row['AutorCriterio'] != "") {
	
					$listaRojaPais = explode(', ', $row['Lista Roja mundial']);
					$listaRojaCategoria = explode(' # ', $row['CategoriaIUCN']);
					$listaRojaCriterio = explode(' # ', $row['CriterioIUCN']);
					$listaRojaAutor = explode(', ', $row['AutorCriterio']);
	
					foreach ($listaRojaPais as $lrpa) {
						$lr = new entities\ListaRoja;
						$lr->setCountry(utf8_encode($lrpa));
						foreach ($listaRojaCategoria as $lrca) {
							$lr->setCategory(utf8_encode($lrca));
							foreach ($listaRojaCriterio as $lrcr) {
								$lr->setCriterionIUCN(utf8_encode($lrcr));
								foreach ($listaRojaAutor as $lrau) {
									$lr->setAuthor(utf8_encode($lrau));
									break;
								}
								break;
							}
							break;
						}
						$especie->addListaRoja($lr);
					}	
				}
	
				//Revision
				$especie->setReviewComments(($row['Revision'] != "") ? utf8_encode($row['Revision']) : NULL);
	
				//Autor Revision
				$especie->setReviewEditor(($row['Revisor'] != "") ? utf8_encode($row['Revisor']) : NULL);
	
				//Fecha Revision
				$especie->setReviewDate(($row['FechaRevision'] != "") ? new \DateTime($row['FechaRevision']) : NULL);
	
				//Comentarios
				$especie->setComments(($row['Comentarios'] != "") ? utf8_encode($row['Comentarios']) : NULL);
				
				$especie->setCreationDate(new \DateTime("now"));
				
				$especie->setStatus(2);
	
				$this->em->persist($especie);
				$this->em->flush();
			}

			else {
				echo $especie->getName()."<br/>";
			}
		}
	}
}

?>
