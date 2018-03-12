<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Reservation {

    private $rsr_num;
    private $gnc_id;
    private $nbr_places_res;
    private $date_reservation;
    private $cln_id;
    private $vlg_num;
    private $date_dep;

    //constructeur
    public function __construct($rsr_num, $gnc_id, $nbr_places_res, $date_reservation, $cln_id, $vlg_num, $date_dep) {

        parent::__construct();

        $this->setNumResa($rsr_num);
        $this->setAgenceId($gnc_id);
        $this->setPlace($nbr_places_res);
        $this->setDateResa($date_reservation);
        $this->setClientId($cln_id);
        $this->setVlgNum($vlg_num);
        $this->setDateDep($date_dep);
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
        return $this->$rsr_num;
    }

    public function getAgenceId() {
        return $this->$gnc_id;
    }

    public function getPlace() {
        return $this->$nbr_places_res;
    }

    public function getDateResa() {
        return $this->$date_reservation;
    }

    public function getClientId() {
        return $this->$cln_id;
    }

    public function sgtVlgNum() {
        return $this->$vlg_num;
    }

    public function getDateDep() {
        return $this->$date_dep;
    }

}
