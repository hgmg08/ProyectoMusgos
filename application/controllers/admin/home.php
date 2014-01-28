<?php

class Home extends CI_Controller {

        //EntityManager
        private $em;
        
        //Constructor
        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url');
                $this->em = $this->doctrine->em;
        }

        public function index()
        {
                if ($this->session->userdata('auth')) {
                        $user= $this->em->find('entities\User', $this->session->userdata('uid'));
                        
                        $this->twiggy->set('role', $user->getRole()->getName());
                        $this->twiggy->set('username', $user->getUsername());
                        $this->twiggy->set('pending_taxons', json_encode($this->getPendingTaxons()));
                        $this->twiggy->title('Musgos de Venezuela | Panel administración');
                        $this->twiggy->template('admin/index')->display();        
                }
                else {
                        redirect('');
                }
        }
        
        private function getPendingTaxons()
        {
                $result = $this->em->getRepository("entities\Taxon")->getAllByStatus(1);
                $taxons = NULL;
                
                foreach ($result as $r) {
                        $taxons[] = array(
                                'id' => $r['id'],
                                'Name' => $r['name'],
                                'Author' => $r['authorInitials'],
                                'Rank' => $this->getRankName($r['rank']),
                                'RankEnum' => $r['rank'],
                                'User' => $this->getCreationUser($r['id'])->getName()
                        );
                }
                
                return $taxons;
        }
        
        private function getCreationUser($taxon_id)
        {
                $taxon = $this->em->find('entities\Taxon', $taxon_id);
                return $taxon->getCreatedUser();
        }
        
        //Get Rank Name
        private function getRankName($rankNumber)
        {
                $rankName = "";
                switch ($rankNumber) {
                        case 0:
                                $rankName = "División";
                                break;
                        case 1:
                                $rankName = "Clase";
                                break;
                        case 2:
                                $rankName = "SubClase";
                                break;
                        case 3:
                                $rankName = "Orden";
                                break;
                        case 4:
                                $rankName = "Familia";
                                break;
                        case 5:
                                $rankName = "Género";
                                break;
                        case 6:
                                $rankName = "Especie";
                                break;
                        case 7:
                                $rankName = "SubEspecie";
                                break;
                        case 8:
                                $rankName = "Variedad";
                                break;
                        default:
                                $rankName = "Sin tipo";
                                break;
                }
                return $rankName;
        }
}

?>
