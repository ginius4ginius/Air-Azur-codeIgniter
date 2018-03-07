<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Clogin extends CI_Controller {
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
        
        public function controle()
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
                            
            $this->form_validation->set_rules('login', 'Le login', 'trim|required|min_length[3]|encode_php_tags');
            $this->form_validation->set_rules('motDePasse', 'Le mot de passe', 'trim|required|min_length[4]|encode_php_tags');

                if ($this->form_validation->run() == false) {
                
                  $this->load->view('login');

                }else {
                 
                    

                
                 $query=$this->Login_model->getLogin();
                 $ref = false;   

                        foreach($query as $key => $value) {
                                if( $value["code_agence"]==$nom && $value["mot_de_passe"]==$mdp ){
                                    $ref = true;
                                }
                        }
                        
                        if($ref==true){
                            $this->load->view('home');
                            //
                            
                            
                        }
                        else{
                            $this->load->view('login');

                        }

	}
        }
        
        public function logout()
	{
            //Détruit la session
            $this->session->sess_destroy();

            //Redirige vers la page d'accueil
            redirect();
        }
}

