<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Model {

    private $rsr_num=null;
    private $gnc_id=null;
    private $nbr_places_res=null;
    private $date_reservation=null;
    private $cln_id=null;
    private $vlg_num=null;
    private $date_dep=null;

    //constructeur
    public function __construct() {

        parent::__construct();

    }
    
    public function makeParameters($gnc_id, $nbr_places_res, $date_reservation, $cln_id, $vlg_num, $date_dep){
        
        $this->gnc_id=$gnc_id;
        $this->nbr_places_res=$nbr_places_res;
        $this->date_reservation=$date_reservation;
        $this->cln_id=$cln_id;
        $this->vlg_num=$vlg_num;
        $this->date_dep=$date_dep;
    }

    //
    ///////////////////////////////////////setters
    private function setNumResa($rsr_num) {
        $this->rsr_num = $rsr_num;
    }

    private function setAgenceId($gnc_id) {
        $this->gnc_id = $gnc_id;
    }

    private function setPlace($nbr_places_res) {
        $this->nbr_places_res = $nbr_places_res;
    }

    private function setDateResa($date_reservation) {
        $this->date_reservation = $date_reservation;
    }

    private function setClientId($cln_id) {
        $this->cln_id = $cln_id;
    }

    private function setVlgNum($vlg_num) {
        $this->vlg_num = $vlg_num;
    }

    private function setDateDep($date_dep) {
        $this->date_dep = $date_dep;
    }

    //
    /////////////////////////////////////getters
    public function getNumResa() {
        return $this->rsr_num;
    }

    public function getAgenceId() {
        return $this->gnc_id;
    }

    public function getPlace() {
        return $this->nbr_places_res;
    }

    public function getDateResa() {
        return $this->date_reservation;
    }

    public function getClientId() {
        return $this->cln_id;
    }

    public function sgtVlgNum() {
        return $this->vlg_num;
    }

    public function getDateDep() {
        return $this->date_dep;
    }

}
