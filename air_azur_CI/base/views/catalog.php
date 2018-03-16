<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
  <?php $this->load->view('head');?>
  <body>
    <div id="container">
      <?php $this->load->view('header');?>
      <br />
        <div id="listeVols">
        Liste des vols
      </div>
      <br /><br />
      <?php 
        echo '<div id="fly_list">';
        echo '<table border="1">';
            echo '<tr>';
            echo '<th>vol</th>';
            echo '<th>Date départ</th>';
            echo '<th>Date arrivée</th>';
            echo '<th>Heure de Départ</th>';
            echo '<th>Heure arrivee</th>';
            echo '<th>Places disponibles</th>';
            echo '<th>Places réservées</th>';
            echo '<th>Prix</th>';
            echo '<th>Aéroport départ</th>';
            echo '<th>Aéroport arrivee</th>';
            echo '<th>Reserver</th>';
            
            echo '</tr>';
            
                foreach($table as $don):
                    echo '<tr>';
                    echo '<td>'.$don->vlg_num.'</td>';
                    echo '<td>'.$don->date_dep.'</td>';
                    echo '<td>'.$don->date_arr.'</td>';
                    echo '<td>'.$don->heure_dep.'</td>';
                    echo '<td>'.$don->heure_arr.'</td>';
                    echo '<td>'.$don->places.'</td>';
                    echo '<td>'.$don->placeBase.'</td>';
                    echo '<td>'.$don->prix.'</td>';
                    echo '<td>'.$don->nomdep.'</td>';
                    echo '<td>'.$don->nomarr.'</td>';
                    
                    $data = array (
                        
                            'num' => $don->vlg_num,

                            'date_dep' => $don->date_dep,);

                        
                    
                    $monlien = base_url("index.php/manager/reserverVol/".$data['date_dep']);
                    echo '<td><a href="'.$monlien.'"><span class="glyphicon glyphicon-edit"></span>   Réserver</a>';
                    echo '</tr>';
                    
            endforeach;     
            
            echo '</table>';
        echo '</div>';
echo '<div/>';
$this->load->view('foot');?>
  </body>
  <script>
    $( document ).ready(function() {
      console.log( "ready to show catalog!" );
      $( "#menu_cat" ).addClass('active');
    });
  </script>
</html>