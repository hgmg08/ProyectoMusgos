<?php

class Taxon extends CI_Controller {

	//EntityManager
	private $em;
	
	//Constructor
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('image_lib');
		$this->load->library('csvreader');
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
		$this->twiggy->set('taxon', $taxon);
		
		if ($taxon->getSynonimClasification() == NULL) {
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
			$loc_pub = array();
			
			//Locaciones
			foreach ($taxon->getLocalidades() as $t) {
				if ($t->getEstado() != null) {
					foreach ($t->getPublications() as $p) {
						$loc_pub[] = $p->getQuote();
					}
	
					$locations[] = array(
						'Estado' => ($t->getEstado() != null)? $t->getEstado()->getName() : '',
						'Municipio' => ($t->getMunicipio() != null)? $t->getMunicipio()->getName() : '',
						'Nombre' => trim($t->getName()),
						'Altitud' => ($t->getMaxAltitude() != $t->getMinAltitude()) ? 
										$t->getMinAltitude()."-".$t->getMaxAltitude() : $t->getMaxAltitude(),
						'Coleccion' => ($t->getCollection() != null)? $t->getCollection() : null,
						'FechaColeccion' => ($t->getCollectionDate() != null)? $t->getCollectionDate()->format('d/m/Y') : null,
						'Herbario' => ($t->getHebarium() != null)? $t->getHebarium() : null,
						'Coordenadas' => ($t->getLatitude() != null and $t->getLongitude() != null)? 
											$t->getLatitude()." ".$t->getLongitude() : null,
						'Referencias' => $loc_pub
					);
				}
				$loc_pub = NULL;
			}
			
			//Estados
			$estados = $this->em->getRepository("entities\Estado")->searchEstados($taxon->getName());
			
			$locat = $taxon->getLocalidades();
			
			//Publicaciones
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
	
			//Endemica
			$endemica = $taxon->getEndemic();
				
			//Ecorregion
			$ecor = $taxon->getEcorregiones();
			foreach ($ecor as $er) {
				$ecorreg[] = $er->getName();
			}
			$ecorregion = implode(", ", $ecorreg);
				
			//Ecosistema
			$ecos = $taxon->getEcosistemas();
			foreach ($ecos as $es) {
				$ecosis[] = $es->getParent()->getName() . " " .$es->getName();
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
			
			//Imagenes
			$galleryDir = 'public/images/gallery/' . $taxon->getId() . '/';
			$thumbsDir = $galleryDir . 'thumbs/';
			$gallery = array();
			$imgFiles = glob($galleryDir . "*.jpg");
			$imgTextFile = glob($galleryDir . "*.csv");
			$imgTextData = $this->csvreader->parse_file($imgTextFile[0]);
			$i = 0;
			foreach ($imgFiles as $img) {
				$imgName = str_replace($galleryDir, "", $img);
				if (!is_file($thumbsDir . $imgName)) {
					$config['source_image'] = $img;
					$config['new_image'] = $thumbsDir . $imgName;
					$config['width'] = 120;
					$config['height'] = 100;
					$config['maintain_ratio'] = TRUE;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					echo $this->image_lib->display_errors();
				}
				$gallery[$i]['img'] = $img;
				$gallery[$i]['thumb'] = $thumbsDir . $imgName;
				for ($j = 0; $j < count($imgTextData); $j++){
					if ($imgTextData[$j]['Imagen'] == str_replace(".jpg", "", $imgName)) {
						$gallery[$i]['desc'] =  "Descripción: " . utf8_encode(trim($imgTextData[$j]["Descripcion"])) . ". " . 
							"Autor: " . utf8_encode(trim($imgTextData[$j]["Autor"])) . ". " . "Colección: " . utf8_encode(trim($imgTextData[$j]["Coleccion"]));
						break;	
					}
				}
				$i++;
			}
		
			//Envio de variables a interfaz
			$this->twiggy->set('rank', $this->fill_rank());
			$this->twiggy->set('endemic', $endemica);
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
			$this->twiggy->set('gallery', $gallery);	
		} 

		else {
			$this->twiggy->set('parentSyno', $taxon->getParentSynonyms());
		}
		
		$auth = $this->session->userdata('auth');
		if ($auth) {
			$this->twiggy->set('username', $this->session->userdata('user'));
		}
		
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
		$rank[6] = 'Especie';
		
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
