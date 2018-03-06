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
            
            $this->form_validation->set_rules('login', 'Le login', 'trim|required|min_length[3]|encode_php_tags');
            $this->form_validation->set_rules('motDePasse', 'Le mot de passe', 'trim|required|min_length[4]|encode_php_tags');

                if ($this->form_validation->run() == false) {
                
                  $this->load->view('login');

                }else {
                 
                    $nom=$_POST["login"];
                    $mdp=$_POST["motDePasse"];

                
                 $query=$this->Login_model->getLogin();
                 //var_dump($nom);
                 //var_dump($mdp);
                 var_dump($query);
                 $ref = false;   

                        foreach($query as $key => $value) {
                            var_dump($value["code_agence"]);
                            var_dump($value["mot_de_passe"]);
                        if( $value["code_agence"]==$nom && $value["mot_de_passe"]==$mdp ){
                            $ref = true;
                        }
                        else{
                            $ref = false;
                         /* var_dump($value["code_agence"]);
                            var_dump($nom);
                            var_dump($value["mot_de_passe"]);
                            var_dump($mdp);*/
                        }
                        
                        }
                        
                        if($ref==true){
                        $this->load->view('home');
                        $this->session->set_userdata($nom, $mdp);
                        }
                        else{
                        $this->load->view('login');

                        }
  
  
                  //$this->session->set_userdata($nom, $mdp);
                  //$this->load->view('home');

                
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

