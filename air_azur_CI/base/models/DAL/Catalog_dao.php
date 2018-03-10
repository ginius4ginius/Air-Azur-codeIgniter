<?php

class Catalog_dao extends CI_Model {


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

}
