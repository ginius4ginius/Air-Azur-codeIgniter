<?php

class Dao extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getLogin(){
        return $this->db->query('SELECT code_agence, mot_de_passe from agence')->result_array();
    }
    
    public function getResa($vData,$vData2) {
        
        $this->db->select("rsr_num,
                client.nom as 'nomClient',
                client.prenom as 'prenomClient',
                reservation.vlg_num as 'vol',
                reservation.date_dep, 
                (select date_arr from vol where date_dep = reservation.date_dep) as 'date_arr' ,
                heure_dep,heure_arr, nbr_places_res as 'place',
                prix as 'prixPlace',
                (nbr_places_res * prix) as 'prixTotal',
                date_reservation as 'dateResa',
                gnc_id,
                reservation.cln_id,
                client.adr_rue as adr_rue ,
                client.adr_cp as adr_cp,
                client.adr_ville as adr_ville
                ");
        $this->db->from('reservation');
        $this->db->join('client', 'client.cln_id = reservation.cln_id');
        $this->db->join('vol_g', 'vol_g.vlg_num= reservation.vlg_num');
        $this->db->where('rsr_num', $vData);
        $this->db->where('gnc_id', $vData2);
        return $this->db->get()->result();
    }
    
    public function getResas() {
        
        $this->db->select("rsr_num,
                client.nom as 'nomClient',
                client.prenom as 'prenomClient',
                reservation.vlg_num as 'vol',reservation.date_dep, 
                (select date_arr from vol where date_dep = reservation.date_dep) as 'date_arr' ,
                heure_dep,heure_arr,
                nbr_places_res as 'place',
                prix as 'prixPlace',
                (nbr_places_res * prix) as 'prixTotal',
                date_reservation as 'dateResa',
                gnc_id,
                client.adr_rue as adr_rue ,
                client.adr_cp as adr_cp,
                client.adr_ville as adr_ville
                ");
        $this->db->from('reservation');
        $this->db->join('client', 'client.cln_id = reservation.cln_id');
        $this->db->join('vol_g', 'vol_g.vlg_num= reservation.vlg_num');

        $this->db->order_by("nom");
        return $this->db->get()->result();
    }
        
    public function deleteResa($vData){
        $this->db->where('rsr_num', $vData);
        $this->db->delete('reservation');      
    }
        
    public function updateResa($tab){
        $this->load->library('Reservation');
        $oPlace=$tab['place'];
            
            foreach($tab['table'] as $don):
                    $data = array (
                            'rsr_num' => $don->rsr_num,
                            'gnc_id' => $don->gnc_id,
                            'dateResa' => $don->dateResa,
                            'cln_id' => $don->cln_id,
                            'vol' => $don->vol,
                            'date_dep' => $don->date_dep);
            endforeach;
        $object = new Reservation();
        $object->makeParameters($data['gnc_id'], $oPlace, $data['dateResa'], $data['cln_id'], $data['vol'], $data['date_dep']);
        $tDonnees_p = array('nbr_places_res' => $object->getPlace());
        $this->db->set($tDonnees_p);
        $this->db->where('rsr_num',$data['rsr_num']);
        $this->db->update('reservation');
    }
        
    public function getAgence($vAgenceLogin){
        $this->db->select('gnc_id');
        $this->db->from('agence');
        $this->db->where('code_agence', $vAgenceLogin);
        return $this->db->get()->result();
    }
    
    public function getAgences(){
        $this->db->select('gnc_id');
        $this->db->from('agence');
        return $this->db->get()->result();
    }
    
    public function getClient($vid) {
        $this->db->select('cln_id,nom,prenom');
        $this->db->from('client');
        $this->db->where('cln_id', $vid);
        return $this->db->get()->result();
    }
    
    public function getClients() {
        $this->db->select('cln_id,nom,prenom');
        $this->db->from('client');
        $this->db->order_by('nom');
        return $this->db->get()->result();
    }
    
    public function getVol($vData) {

        $this->db->select("vol.vlg_num, vol.date_dep, 
            vol.date_arr ,
            v.heure_dep,
            v.heure_arr,
           (nbr_places - coalesce((select sum(nbr_places_res) from reservation r where r.vlg_num=vol.vlg_num and r.date_dep=vol.date_dep), 0))as places,
            v.prix,
            ad.arp_nom as 'nomdep',
            aa.arp_nom as 'nomarr'");
        $this->db->from('vol', 'vol_g', 'aeroport');
        $this->db->join('vol_g as v', 'v.vlg_num = vol.vlg_num');
        $this->db->join('aeroport as ad', 'ad.code = v.code_arp_dep');
        $this->db->join('aeroport as aa', 'aa.code = v.code_arp_arr');
        $this->db->where('date_dep', $vData);
        $this->db->limit(1);
        return $this->db->get()->result();
    }
    
    public function getVols() {

        $this->db->select("vol.vlg_num, vol.date_dep, 
            vol.date_arr ,
            v.heure_dep,
            v.heure_arr,
           (nbr_places - coalesce((select sum(nbr_places_res) from reservation r where r.vlg_num=vol.vlg_num and r.date_dep=vol.date_dep), 0))as places,
            v.prix,
            ad.arp_nom as 'nomdep',
            aa.arp_nom as 'nomarr'");
        $this->db->from('vol', 'vol_g', 'aeroport');
        $this->db->join('vol_g as v', 'v.vlg_num = vol.vlg_num');
        $this->db->join('aeroport as ad', 'ad.code = v.code_arp_dep');
        $this->db->join('aeroport as aa', 'aa.code = v.code_arp_arr');
        $this->db->order_by("vol.date_dep");
        return $this->db->get()->result();
    }
    
    public function addClient($oClient){
        $this->load->library('Client');
        $object = new Client();
        $object->makeParameters($oClient['nom'], $oClient['prenom'], $oClient['adr_rue'], $oClient['adr_cp'], $oClient['adr_ville']);
            
        $this->db->set('nom', $object->getNom());
        $this->db->set('prenom', $object->getPrenom());
        $this->db->set('adr_rue', $object->getAdrRue());
        $this->db->set('adr_cp', $object->getAdrCp());
        $this->db->set('adr_ville', $object->getAdrVille());
        $this->db->insert('client');
    }
    
    public function addReservation($tab){
        $this->load->library('Reservation');
        $object = new Reservation();
        $object->makeParameters($tab['gnc_id'], $tab['nbr_places'], $tab['date_reservation'], $tab['cln_id'], $tab['vlg_num'], $tab['date_dep']);
            
        $this->db->set('gnc_id', $object->getAgenceId());
        $this->db->set('nbr_places_res', $object->getPlace());
        $this->db->set('date_reservation', $object->getDateResa());
        $this->db->set('cln_id', $object->getClientId());
        $this->db->set('vlg_num', $object->getVlgNum());
        $this->db->set('date_dep', $object->getDateDep());
        $this->db->insert('reservation');
    }

}