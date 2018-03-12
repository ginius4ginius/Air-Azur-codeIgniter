<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('fpdf/fpdf.php');

class MyFpdf extends Fpdf {
    
    function __construct(){
        parent::__construct();
        $CI =& get_instance();
    }
            
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

