<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
    
    //chargement automatique
    // l'index renvoi à la page demandé
	public function index()
	{
            $sLocation = "login";
                    if(isset($_REQUEST['action'])) {
                            switch($_REQUEST['action']) {
                              case 'reservation':
                                $sLocation = "reservation.php";
                                break;
                              //
                              case 'catalog':
                                $sLocation = "catalog.php";
                                break;
                              //
                              case 'home':
                                $sLocation = "home.php";
                                break;
                            }
                          }
                          
                    //----------- go to location
                    $this->load->view($sLocation);
                    //exit();
                    //
	}
     
    //appel de la fonction depuis la vue login qui controle le formulaire
    //envoi à login si false ou à home si true    
        public function controleLogin()
	{
            $nom=$_POST["login"];
            $mdp=$_POST["motDePasse"];
            //attribution des données pour la session utilisateur
                            $newdata = array(
                            'login'  => $nom,
                            'password'     => $mdp,
                            'logged_in' => TRUE
                            );

                            $this->session->set_userdata($newdata);
                            $this->form_validation->set_rules('login', 'login', 'trim|required|min_length[3]|encode_php_tags');
                            $this->form_validation->set_rules('motDePasse', 'mot de passe', 'trim|required|min_length[4]|encode_php_tags');

                if ($this->form_validation->run() == false) {
                    $this->load->view('login');
                }else {
                 $query=$this->Login_dao->getLogin();
                 $ref = false;   

                        foreach($query as $key => $value) {
                                if( $value["code_agence"]==$nom && $value["mot_de_passe"]==$mdp ){
                                    $ref = true;
                                }
                        }
                        
                        if($ref==true){
                            $this->load->view('home');
                        }
                        else{
                            $this->load->view('login');
                        }
                }
        }
        
        public function controleUpdateResa(){
            $vData= $this->uri->segment(3);
            $place=$_POST["places"];
            
            $this->form_validation->set_rules('places', 'nom de places', 'trim|required|min_length[1]|encode_php_tags');
            
            if ($this->form_validation->run() == false) {
                
            $data['table']= $this->Reservations_dao->getResas();
            $this->load->view('reservations',$data);   
            
                }else {
                    
            
            $tab['table']= $this->Reservations_dao->getResa($vData);
            $tab['place']=$_POST["places"];
            $this->Reservations_dao->updateResa($tab);
            $data['table']= $this->Reservations_dao->getResas();
            $this->load->view('reservations',$data);
                }
        }
        
        public function controleClient(){
            $vData= $this->uri->segment(3);
             $this->form_validation->set_rules('nom', 'nom', 'trim|required|min_length[2]|encode_php_tags');
              $this->form_validation->set_rules('prenom', 'prenom', 'trim|required|min_length[2]|encode_php_tags');
               $this->form_validation->set_rules('adr_rue', 'rue', 'trim|required|min_length[5]|encode_php_tags');
                $this->form_validation->set_rules('adr_cp', 'code postal', 'trim|required|min_length[5]|encode_php_tags');
                 $this->form_validation->set_rules('adr_ville', 'ville', 'trim|required|min_length[2]|encode_php_tags');
            
            if ($this->form_validation->run() == false) {
                $data['tab1e']= $this->Reservation_dao->getVol($vData);
                $this->load->view('newClient',$vData);
           // $this->affichageDesVols();    
            
                }else {
                    $oClient['nom']=$_POST["nom"];
                    $oClient['prenom']=$_POST["prenom"];
                    $oClient['adr_rue']=$_POST["adr_rue"];
                    $oClient['adr_cp']=$_POST["adr_cp"];
                    $oClient['adr_ville']=$_POST["adr_ville"];
                    
                    $this->Reservation_dao->addClient($oClient);
                    $data['tab1e']= $this->Reservation_dao->getVol($vData);
                    $data['client']= $this->Reservation_dao->getClients();
                    
                     $this->load->view('newReservation',$data);
                  //  $this->affichageDesVols();
            
                }
        }
        
        public function controleResa(){
            
            
        }
        
    //fonction appelée par le menu qui redirige à la vue login et détruit la session en cour    
        public function logout()
	{
            //Détruit la session
            $this->session->sess_destroy();

            //Redirige vers la page d'accueil
            redirect();
        }
        
        
    //fonction appelée depuis le menu qui renvoi à la page catalog    
    //fonction qui affiche les vols
        public function affichageDesVols(){
          $data['table']= $this->Catalog_dao->getVols();
          $this->load->view('catalog',$data);

        }
        
    
    //fonction appelée depuis catalog et qui renvoi à la page reservation
    //cette fonction transmet les données du vol et la liste des clients    
        public function reserverVol(){
          $vData= $this->uri->segment(3);
          $data['tab1e']= $this->Reservation_dao->getVol($vData);
          $data['client']= $this->Reservation_dao->getClients();
          $this->load->view('newReservation',$data);
          var_dump($data['client']);
        }
        
        
        public function affichageDesReservations(){
          $data['table']= $this->Reservations_dao->getResas();
          $this->load->view('reservations',$data);
        }
        
        public function supprimerReservation(){
            $vData= $this->uri->segment(3);
            $this->Reservations_dao->deleteResa($vData);
            $data['table']= $this->Reservations_dao->getResas();
            $this->load->view('reservations',$data);
        }
        
        public function modifierReservation(){
            $vData= $this->uri->segment(3);
            $data['table']= $this->Reservations_dao->getResa($vData);
            $data['num']= $vData;
            $this->load->view('updateReservation',$data);
        }
        
        
        public function pdf(){
            $vData= $this->uri->segment(3);
            $data['table']= $this->Reservations_dao->getResa($vData);
           // $this->load->library('myFpdf');
            $this->load->view('fpdf',$data);
            
        }
        
        public function ajouterClient(){
            $vData= $this->uri->segment(3); //date_dep
            $data['table']= $this->Reservation_dao->getVol($vData);
           // var_dump($data);
            $this->load->view('newClient',$data);
        }
        
        
        
       
        
        
        
        
        
}

