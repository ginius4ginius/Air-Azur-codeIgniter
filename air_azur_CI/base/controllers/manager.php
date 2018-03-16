<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
    
    //chargement automatique de la page login
	public function index(){
            $this->load->view("login");
	}
       
    /* appel de la fonction depuis le menu
     * envoi à la vue home 
     */
        public function affichageHome(){
            $this->load->view("home");
        }
        
    /* appel de la fonction depuis la vue login qui controle le formulaire
     * envoi à login si false ou à home si true 
     */
        public function controleLogin(){
            
            $nom=$_POST["login"];
            $mdp=$_POST["motDePasse"];
            //creation des données pour la session utilisateur
                            $newdata = array(
                            'login'  => $nom,
                            'password'     => $mdp,
                            'logged_in' => TRUE
                            );

                            $this->session->set_userdata($newdata);// initialisation de la session                
                            $this->form_validation->set_rules('login', 'login', 'trim|required|min_length[3]|encode_php_tags');
                            $this->form_validation->set_rules('motDePasse', 'mot de passe', 'trim|required|min_length[4]|encode_php_tags');

                if ($this->form_validation->run() == false) {
                    $this->load->view('login');
                }else {
                 
                 $query=$this->Dao->getLogin();
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
        
    /* permettant de controler les données lors de la mise à jour de la réservation
     * renvoi à la page des reservations après mise à jour des données 
     */   
        public function controleUpdateResa(){
            $vData= $this->uri->segment(3);
            $vData2= $this->uri->segment(4);
            $place=$_POST["places"];
            
            $this->form_validation->set_rules('places', 'nom de places', 'trim|required|numeric|min_length[1]|encode_php_tags');
            
            if ($this->form_validation->run() == false) {
                
            $this->modifierReservation();
            
                }else {
            $tab['table']= $this->Dao->getResa($vData,$vData2);
            $tab['place']=$_POST["places"];
            $this->Dao->updateResa($tab);
            $data['table']= $this->Dao->getResas();
            $this->load->view('reservations',$data);
                }
        }
        
    /* permettant de controler les données lors de la creation d'un client
     * renvoi à la page nouvelle réservation après avoir inséré le client dans la base de donnée 
     */ 
        public function controleClient(){
            $vData= $this->uri->segment(3);
            $this->form_validation->set_rules('nom', 'nom', 'trim|required|min_length[2]|alpha|encode_php_tags');
            $this->form_validation->set_rules('prenom', 'prenom', 'trim|required|min_length[2]|alpha|encode_php_tags');
            $this->form_validation->set_rules('adr_rue', 'rue', 'trim|required|min_length[5]|encode_php_tags');
            $this->form_validation->set_rules('adr_cp', 'code postal', 'trim|numeric|required|min_length[5]|max_length[5]|encode_php_tags');
            $this->form_validation->set_rules('adr_ville', 'ville', 'trim|required|min_length[2]|alpha|encode_php_tags');
            
            if ($this->form_validation->run() == false) {
                $this->ajouterClient();
                
                }else {
                    $oClient['nom']=$_POST["nom"];
                    $oClient['prenom']=$_POST["prenom"];
                    $oClient['adr_rue']=$_POST["adr_rue"];
                    $oClient['adr_cp']=$_POST["adr_cp"];
                    $oClient['adr_ville']=$_POST["adr_ville"];
                    
                    $this->Dao->addClient($oClient);
                    $data['tab1e']= $this->Dao->getVol($vData);
                    $data['client']= $this->Dao->getClients();
                    
                     $this->load->view('newReservation',$data);
            
                }
        }
        
    /* permettant de controler les données lors de la création d'une réservation
     * renvoi à la page catalo après avoir inséré la nouvelle réservation dans la base de donnée
     */
        public function controleResa(){
            $vData= $this->uri->segment(3);
            $this->form_validation->set_rules('nbrPlaces', 'places', 'trim|required|min_length[1]|numeric|encode_php_tags');
            
            if ($this->form_validation->run() == false) {
                $data['tab1e']= $this->Dao->getVol($vData);
                $data['client']= $this->Dao->getClients();
                $this->load->view('newReservation',$data);
            
                }else {
                    $vAgenceLogin = $_SESSION["login"];
                    $data['vol']= $this->Dao->getVol($vData);
                    $data['client']= $this->Dao->getClient($_POST["cln_id"]);
                    $data['agence']=$this->Dao->getAgence($vAgenceLogin);
                    
                    foreach( $data['vol'] as $don):
                        $oResa['vlg_num']=$don->vlg_num;
                        $oResa['date_dep']=$don->date_dep;
                    endforeach;
                    
                    foreach( $data['agence'] as $don):
                        $oResa['gnc_id']=$don->gnc_id;
                    endforeach;
                    
                    foreach( $data['client'] as $don):
                        $oResa['cln_id']=$don->cln_id;
                    endforeach;
                    
                    
                    $oResa['nbr_places']=$_POST["nbrPlaces"];
                    $oResa['date_reservation']=date("Y-m-d");
                    
                    $this->Dao->addReservation($oResa);
                    $this->affichageDesVols();
            
                }
        }
        
    //fonction appelée par le menu qui redirige à la vue login et détruit la session en cour    
        public function logout()
	{
            //Détruit la session
            $this->session->sess_destroy();

            //Redirige vers la page d'accueil
            redirect();
        }
        
        
    /*fonction appelée depuis le menu qui renvoi à la page catalog   
     * fonction qui affiche les vols
     */ 
        public function affichageDesVols(){
            
            $data['table']= $this->Dao->getVols();
            $this->load->view('catalog',$data);
            
        }
        
    
    /*fonction appelée depuis catalog et qui renvoi à la page reservation
     *cette fonction transmet les données du vol et la liste des clients
     */     
        public function reserverVol(){
            
           $vData= $this->uri->segment(3);
           $data['tab1e']= $this->Dao->getVol($vData);
           $data['client']= $this->Dao->getClients();
           $this->load->view('newReservation',$data);
        }
        
    //fonction qui permet d'afficher les reservations dans la vue reservations    
        public function affichageDesReservations(){
            
            $data['table']= $this->Dao->getResas();
            $data['agence']= $this->Dao->getAgences();
            $this->load->view('reservations',$data);
            
        }
    
    //fonction qui permet de supprimer une réservation et renvoi à la vue réservations
        public function supprimerReservation(){
            
            $vData= $this->uri->segment(3);
            $this->Dao->deleteResa($vData);
            $data['table']= $this->Dao->getResas();
            $this->load->view('reservations',$data);
        }
    
    /*fonction qui permet de modifier une réservation en envoyant les données de la 
     * réservation à la vue updateReservation
     */
        public function modifierReservation(){
            $vData= $this->uri->segment(3);
            $vData2= $this->uri->segment(4);
            $data['table']= $this->Dao->getResa($vData,$vData2);
            $data['num']= $vData;
            $this->load->view('updateReservation',$data);
        }
        
    //fonction appelant la vue newClient pour créer un client 
        public function ajouterClient(){
            $vData= $this->uri->segment(3);
            $data['table']= $this->Dao->getVol($vData);
            $this->load->view('newClient',$data);
        }
        
    //fonction appelant la vue PDF de la réservation ( charge un pdf)    
        public function pdf(){
            $vData= $this->uri->segment(3);
            $vData2= $this->uri->segment(4);
            $data['table']= $this->Dao->getResa($vData,$vData2);
            $this->load->library('myFpdf');
            $this->load->view('fpdf',$data);
            
        }       
}

