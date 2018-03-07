<?php

class Catalog_dao extends CI_Model{
    
    protected $table = 'vol';
    
    public function getVol(){
        return $this->db->get($this->table); 
       // return $this->db->query('SELECT * from vol')->result_array();
    }
    
    
    
}