<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('fpdf/fpdf.php');

class MyFpdf extends Fpdf {
    
    function __construct(){
        parent::__construct();
        $CI =& get_instance();
    }
            
}
