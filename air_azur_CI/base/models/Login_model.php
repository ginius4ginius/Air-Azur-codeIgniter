<?php

class Login_model extends CI_Model{
    
    public function getLogin(){
       /* $query = $this->db->query('SELECT code_agence, mot_de_passe from agence');
        $rowQuery = $query->row_array();*/
        return $this->db->query('SELECT code_agence, mot_de_passe from agence')->result_array();
       /* 
        foreach ($query->result_array() as $row)
{
        $aResultSet = $row['code_agence'];
        $aResultSet = $row['mot_de_passe'];
}
    return $aResultSet;

      foreach ($query->result() as $row)
        {
                echo $row->code_agence;
                echo $row->mot_de_passe;
        }*/
    }
    
    
    
}
