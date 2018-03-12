<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
  <?php $this->load->view('head');?>
  <body>
    <div id="container">
      <?php $this->load->view('header');
      echo '<br />';
      
            foreach($table as $don):
          echo'<div id="reservation">';
            echo 'Réservation n° '.$don->rsr_num;
            echo '</div>';
            echo '<br><br>';
    // var_dump($table);
            echo '<div class="modal-body">';
          
            echo  '<div>';
            echo  'Vol : '.$don->vol. '<br /><br />';
            echo  'Nom : '.$don->nomClient.' '.$don->prenomClient.'<br />';
            echo  'Départ : '.$don->date_dep.' - '.$don->heure_dep.'<br />';
            echo  'Arrivée : '.$don->date_arr.' - '.$don->heure_arr.'<br />';
            echo  'Prix par place HT : '.$don->prixPlace.' €<br><br>';
            
            echo form_open('manager/controleNewResa');
            echo form_label('Nombre de places :', 'places');
            $login= array('name'=>'Nombre de places','id'=>'places','value'=>set_value(".$don->place."));
            echo form_input($login);
            echo '<br /><br />';
            echo '</div>';
            endforeach;
            echo form_submit('envoi', 'Connexion');
            echo form_reset('reset', 'Effacer');
            
            echo '</center>';
            echo '</div>';
            echo form_close();
            echo '<br />';
            echo '<a class="stylebouton" href="'. base_url().'index.php/manager/affichageDesReservations">Retour</a>';
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