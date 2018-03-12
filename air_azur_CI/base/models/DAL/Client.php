<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client {

    private $cln_id;
    private $nom;
    private $prenom;
    private $adr_rue;
    private $adr_cp;
    private $adr_ville;

    //constructeur
    public function __construct($cln_id, $nom, $prenom, $adr_rue, $adr_cp, $adr_ville) {

        parent::__construct();

        $this->setClientId($cln_id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setAdrRue($adr_rue);
        $this->setAdrCp($adr_cp);
        $this->setAdrVille($adr_ville);
    }

    //
    ///////////////////////////////////////setters
    private function setClientId($cln_id) {
        $this->cln_id = $cln_id;
    }

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
        return $this->$cln_id;
    }

    public function getNom() {
        return $this->$nom;
    }

    public function getPrenom() {
        return $this->$prenom;
    }

    public function getAdrRue() {
        return $this->$adr_rue;
    }

    public function getAdrCp() {
        return $this->$adr_cp;
    }

    public function getAdrVille() {
        return $this->$adr_ville;
    }

}
