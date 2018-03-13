<?php 
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
  <?php $this->load->view('head');?>
  <body>
    <div id="container">
      <?php $this->load->view('header');?>
      <br />
        <div id="listeResa">
        Liste des réservations
      </div>
      <br /><br />
      <?php 
        echo '<div id="reservation_list">';
        echo '<table border="1">';
            echo '<tr>';
            echo '<th>Nom</th>';
            echo '<th>Prénom</th>';
            echo '<th>Vol</th>';
            echo '<th>Départ</th>';
            echo '<th>Arrivee</th>';
            echo '<th>Place</th>';
            echo '<th>Prix</th>';
            echo '<th>Date réservation</th>';
            echo '<th>Modifier</th>';
            echo '<th>Supprimer</th>';
            echo '<th>Télécharger</th>';
            
            echo '</tr>';
                foreach($table as $don):
                    echo '<tr>';
                    echo '<td>'.$don->nomClient.'</td>';
                    echo '<td>'.$don->prenomClient.'</td>';
                    echo '<td>'.$don->vol.'</td>';
                    echo '<td>'.$don->date_dep.' - '.$don->heure_dep.'</td>';
                    echo '<td>'.$don->date_arr.' - '.$don->heure_arr.'</td>';
                    echo '<td>'.$don->place.'</td>';
                    echo '<td>'.$don->prixTotal.'</td>';
                    echo '<td>'.$don->dateResa.'</td>';
                    
                    $data = array (
                        'rsr_num'=>$don->rsr_num,
                        'gnc_id'=>$don->gnc_id 
                            );  
                    $monlienModif = base_url("index.php/manager/modifierReservation/".$data['rsr_num']."/".$data['gnc_id']);
                    $monlienDelete = base_url("index.php/manager/supprimerReservation/".$data['rsr_num']);
                    $monlienPdf = base_url("index.php/manager/pdf/".$data['rsr_num']."/".$data['gnc_id']);
                    echo '<td><a href="'.$monlienModif.'"><span class="glyphicon glyphicon-edit"></span>   Modifier</a>';
                    echo '<td><a href="'.$monlienDelete.'"><span class="glyphicon glyphicon-trash"></span>   Supprimer</a>';
                    echo '<td><a href="'.$monlienPdf.'"><span class="glyphicon glyphicon-envelope"></span>   Télécharger</a>';
                    echo '</tr>';
                    
            endforeach;     
            
            echo '</table>';
        echo '</div>';
echo '<div/>';
echo '<br /><br /><br /><br /><br />';
$this->load->view('foot');?>
  </body>
  <script>
    $( document ).ready(function() {
      console.log( "ready to show reservations!" );
      $( "#menu_res" ).addClass('active');
    });
  </script>
</html>