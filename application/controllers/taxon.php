<?php

class Taxon extends CI_Controller {

	//EntityManager
	private $em;
	
	//Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->em = $this->doctrine->em;
	}
	
	//Method remaping
	public function _remap($method)
	{
		$param_offset = 2;
		
		if (!method_exists($this, $method)) {
			$param_offset = 1;
			$method = 'index';
		}
		
		$params = array_slice($this->uri->rsegment_array(), $param_offset);
		call_user_func_array(array($this, $method), $params);
	}  
	
	//Index
	public function index($taxon_id = null)
	{
		if ($taxon_id != null) {
			$taxon = $this->find_taxon($taxon_id);
			if ($taxon != null) {
				$this->populate($taxon);
			}
			else {
				show_404('Taxon');
			}
		}
		else {
			show_404('Taxon');
		}
	}
	
	//Find taxon
	private function find_taxon($taxon_id)
	{
		$taxon = $this->em->find('entities\Taxon', $taxon_id);
		if ($taxon != null) {
			return $taxon;
		}
		else {
			return null;
		}
	}
	
	//Populate taxon page variables
	private function populate($taxon)
	{
		$locations = null;
		$publications = array();
		$hierarchy = array();
		$sust = array();
		$habi = array();
		$sinonimos = array();
		$ecorreg = array();
		$ecosis = array();
		$basionimo = null;
		$listaRoja = array();
		$cambioClimatico = array();
		
		//Locaciones
		foreach ($taxon->getLocalidades() as $t) {
			if ($t->getEstado() != null) {
				$locations[] = array(
					'Estado' => ($t->getEstado() != null)? $t->getEstado()->getName() : '',
					'Municipio' => ($t->getMunicipio() != null)? $t->getMunicipio()->getName() : '',
					'Nombre' => $t->getName(),
					'Altitud' => ($t->getMaxAltitude() != $t->getMinAltitude()) ? 
									$t->getMinAltitude()."-".$t->getMaxAltitude() : $t->getMaxAltitude(),
					'Coleccion' => ($t->getCollection() != null)? $t->getCollection() : null,
					'FechaColeccion' => ($t->getCollectionDate() != null)? $t->getCollectionDate()->format('d/m/Y') : null,
					'Herbario' => ($t->getHebarium() != null)? $t->getHebarium() : null,
					'Coordenadas' => ($t->getLatitude() != null and $t->getLongitude() != null)? 
										$t->getLatitude()." ".$t->getLongitude() : null
				);
			}
		}
		
		//Estados
		$estados = $this->em->getRepository("entities\Estado")->searchEstados($taxon->getName());
		
		$locat = $taxon->getLocalidades();
		
		//Publicaciones
		/*foreach ($locat as $loc) {
			foreach($loc->getPublications() as $p) {
				$publications[] = $p;
			}
		}*/
		$publications = $this->em->getRepository("entities\Publicacion")->searchPublicaciones($taxon->getName());
			
		//Jerarquia
		$taxon_aux = $taxon;
		while ($taxon_aux = $taxon_aux->getParentHierarchy()) {
			$hierarchy[] = $taxon_aux;
		}
			
		//Sustrato
		$sus = $taxon->getSustratos();
		foreach ($sus as $s) {
			if ($s->getParent() != null) {
				$sust[] = $s->getName();
				$this->checkHabitat($habi, $s->getParent()->getName());
			}
			
			else {
				$this->checkHabitat($habi, $s->getName());
			}
		}
		
		$sustrato = implode(", ", $sust);
		$habitat = implode(", ", $habi);
		
		//Sinonimos
		$sin = $taxon->getChildrenSynonyms();
		foreach ($sin as $s) {
			if ($s->getSynonimClasification() == 1) {
				$sinonimos[] = $s;
			}
		}
			
		//Basionimo
		foreach ($sin as $s) {
			if ($s->getSynonimClasification() == 2) {
				$basionimo = $s;
				break;
			}
		}
			
		//Ecorregion
		$ecor = $taxon->getEcorregiones();
		foreach ($ecor as $er) {
			$ecorreg[] = $er->getName();
		}
		$ecorregion = implode(", ", $ecorreg);
			
		//Ecosistema
		$ecos = $taxon->getEcosistemas();
		foreach ($ecos as $es) {
			$ecosis[] = $es->getName();
		}
		$ecosistema = implode(", ", $ecosis);
		
		//Lista Roja
		$listaR = $taxon->getListasRojas();
		foreach ($listaR as $lr) {
			if ($lr != null) {
				$listaRoja[] = $lr;	
			}
			else {
				$listaRoja = null;
			}
		}
		
		//Cambio Climatico
		$cambioC = $taxon->getCambiosClimaticos();
		foreach ($cambioC as $cc) {
			if ($cc != null) {
				$cambioClimatico[] = $cc;	
			}
			else {
				$cambioClimatico = null;
			}
		}

		//Envio de variables a interfaz
		$this->twiggy->set('taxon', $taxon);
		$this->twiggy->set('rank', $this->fill_rank());
		$this->twiggy->set('locations', json_encode($locations));
		$this->twiggy->set('estados', $estados);
		$this->twiggy->set('publications', $publications);
		$this->twiggy->set('hierarchy', $hierarchy);
		$this->twiggy->set('sustratos', $sustrato);
		$this->twiggy->set('habitat', $habitat);
		$this->twiggy->set('sinonimos', $sinonimos);
		$this->twiggy->set('basionimo', $basionimo);
		$this->twiggy->set('ecorregion', $ecorregion);
		$this->twiggy->set('ecosistema', $ecosistema);
		$this->twiggy->set('listaRoja', $listaRoja);
		$this->twiggy->set('cambioClimatico', $cambioClimatico);
		
		$this->twiggy->title('Musgos de Venezuela')->append($taxon->getName());
		$this->twiggy->template('main/taxon')->display();
	}

	private function fill_rank()
	{
		$rank = array();
		$rank[0] = 'División';
		$rank[1] = 'Clase';
		$rank[2] = 'Subclase';
		$rank[3] = 'Orden';
		$rank[4] = 'Familia';
		$rank[5] = 'Género';
		
		return $rank;
	}
	
	private function checkHabitat(&$habitat = array(), $name) {
		$check = false;
		
		if (empty($habitat)) {
			$habitat[] = $name;	
		}
		foreach ($habitat as $h) {
			if ($h == $name) {
				$check = true;
				break;
			}
		} 
		
		if (!$check) {
			$habitat[] = $name;	
		}
	}
}

?>
