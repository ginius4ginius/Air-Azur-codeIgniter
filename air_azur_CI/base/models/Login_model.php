<?php

class Login_model extends CI_Model{
    
    public function getLogin(){
        return $this->db->query('SELECT code_agence, mot_de_passe from agence')->result_array();
    }
    
    
    
}
