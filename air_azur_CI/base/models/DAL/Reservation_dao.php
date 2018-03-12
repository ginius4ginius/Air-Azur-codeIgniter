<?php

class Reservation_dao extends CI_Model {

    public function getClients() {
        $this->db->select('nom,prenom');
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
    
    public function addClient($oClient){
        $this->load->library('Client');
            $object = new Client();
            $object->makeParameters($oClient['nom'], $oClient['prenom'], $oClient['adr_rue'], $oClient['adr_cp'], $oClient['adr_ville']);
           // $this->db->insert('client', $object);
            
            $this->db->set('nom', $object->getNom());
            $this->db->set('prenom', $object->getPrenom());
            $this->db->set('adr_rue', $object->getAdrRue());
            $this->db->set('adr_cp', $object->getAdrCp());
            $this->db->set('adr_ville', $object->getAdrVille());
            $this->db->insert('client');
    }
    
    public function addReservation($tab){
        $this->load->library('Reservation');
        foreach($tab['table'] as $don):
                    $data = array (
                            'gnc_id' => $don->gnc_id,
                            'nbr_places_res' => $don->nbr_places_res,
                            'dateResa' => $don->dateResa,
                            'cln_id' => $don->cln_id,
                            'vol' => $don->vol,
                            'date_dep' => $don->date_dep);
            endforeach;
            $object = new Reservation();
            $object->makeParameters($data['gnc_id'], $data['nbr_places_res'], $data['dateResa'], $data['cln_id'], $data['vol'], $data['date_dep']);
            $this->db->insert('reservation', $object);
    }
}
