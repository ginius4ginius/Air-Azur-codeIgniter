<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vol extends CI_Model {

    private $numVol=null;
    private $datedep=null;
    private $dateArr=null;
    private $heureDep=null;
    private $heureArr=null;
    private $places=null;
    private $prix=null;
    private $aeroDepart=null;
    private $aeroArr=null;

    //constructeur
    public function __construct() {

        parent::__construct();
    }
    
    public function makeParameters($date_dep, $date_arr, $heure_dep, $heure_arr, $nbr_places, $prix, $code_arp_dep, $code_arp_arr) {

        $this->date_dep=($date_dep);
        $this->date_arr=($date_arr);
        $this->heure_dep=($heure_dep);
        $this->heure_arr=($heure_arr);
        $this->nbr_places=($nbr_places);
        $this->prix=($prix);
        $this->code_arp_dep=($code_arp_dep);
        $this->code_arp_arr=($code_arp_arr);
    }

    //
    ///////////////////////////////////////setters

    private function setDatedep($date_dep) {
        $this->datedep = $date_dep;
    }

    private function setDateArr($date_arr) {
        $this->dateArr = $date_arr;
    }

    private function setHeureDep($heure_dep) {
        $this->heureDep = $heure_dep;
    }

    private function setHeureArr($heure_arr) {
        $this->heureArr = $heure_arr;
    }

    private function setPlaces($nbr_places) {
        $this->places = $nbr_places;
    }

    private function setPrix($prix) {
        $this->prix = $prix;
    }

    private function setAeroDepart($code_arp_dep) {
        $this->aeroDepart = $code_arp_dep;
    }

    private function setAeroArr($code_arp_arr) {
        $this->aeroArr = $code_arp_arr;
    }

    //
    /////////////////////////////////////getters
    public function getNumVol() {
        return $this->numVol;
    }

    public function getDatedep() {
        return $this->date_dep;
    }

    public function getDateArr() {
        return $this->date_arr;
    }

    public function getHeureDep() {
        return $this->heure_dep;
    }

    public function getHeureArr() {
        return $this->heure_arr;
    }

    public function getPlaces() {
        return $this->nbr_places;
    }

    public function getPrix() {
        return $this->vlg_num;
    }

    public function getAeroDepart() {
        return $this->code_arp_dep;
    }

    public function getAeroArr() {
        return $this->code_arp_arr;
    }

}
