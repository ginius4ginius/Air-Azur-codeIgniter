<?php

class Login_dao extends CI_Model{
    
   public function __construct(){
        
    parent::__construct();
    
    
    
   }
    
    public function getLogin(){
        return $this->db->query('SELECT code_agence, mot_de_passe from agence')->result_array();
    }
    
    
    
}
