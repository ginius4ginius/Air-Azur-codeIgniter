<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Model {

    private $cln_id=null;
    private $nom=null;
    private $prenom=null;
    private $adr_rue=null;
    private $adr_cp=null;
    private $adr_ville=null;

    //constructeur
    public function __construct() {

        parent::__construct();
    }
    
    public function makeParameters($nom, $prenom, $adr_rue, $adr_cp, $adr_ville) {

        $this->nom=($nom);
        $this->prenom=($prenom);
        $this->adr_rue=($adr_rue);
        $this->adr_cp=($adr_cp);
        $this->adr_ville=($adr_ville);
    }

    //
    ///////////////////////////////////////setters

    private function setNom($nom) {
        $this->nom = $nom;
    }

    private function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    private function setAdrRue($adr_rue) {
        $this->adr_rue = $adr_rue;
    }

    private function setAdrCp($adr_cp) {
        $this->adr_cp = $adr_cp;
    }

    private function setAdrVille($adr_ville) {
        $this->adr_ville = $adr_ville;
    }

    //
    /////////////////////////////////////getters
    public function getClientId() {
        return $this->cln_id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getAdrRue() {
        return $this->adr_rue;
    }

    public function getAdrCp() {
        return $this->adr_cp;
    }

    public function getAdrVille() {
        return $this->adr_ville;
    }

}
