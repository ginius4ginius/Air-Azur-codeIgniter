<?php

class Reservations_dao extends CI_Model {
    
    public function getResa($vData) {
        
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
                client.adr_rue as adr_rue ,
                client.adr_cp as adr_cp,
                client.adr_ville as adr_ville
                ");
            $this->db->from('reservation');
            $this->db->join('client', 'client.cln_id = reservation.cln_id');
            $this->db->join('vol_g', 'vol_g.vlg_num= reservation.vlg_num');
            $this->db->where('rsr_num', $vData);
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
        
        public function updateResa($oData){
            //code
        }

}


/*
 * 
 * (nbr_places_res*(select prix from vol_g where vol_g.vlg_num = (select vlg_num from reservation))) as 'prix',
                date_reservation as 'dateResa'
 * 
 * 
                    echo '<td>'.$don->nomClient.'</td>';
                    echo '<td>'.$don->prenomClient.'</td>';
                    echo '<td>'.$don->arrivee.'</td>';
                    echo '<td>'.$don->depart.'</td>';
                    echo '<td>'.$don->place.'</td>';
                    echo '<td>'.$don->prix.'</td>';
                    echo '<td>'.$don->dateResa.'</td>';
 * */
 