<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccatalog extends CI_Controller {
    
    
    public function __construct()
        {
                parent::__construct();
                 $this->load->library('Vol');
                 $aListVol;
        }
    
    
	public function index()
	{
            
                    
        }
        
        public function affichageVols(){
            $lastScores = $this->Catalog_dao->getVol();
            
            foreach ($lastScores as $lastScore) {
                    $aListVol = $lastScore;
                       // echo $lastScore->score.'<br>' ;
                    }
                    
                    echo $aListVol;
        }
        
        
}