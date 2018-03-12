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
          
        echo  '<div>';
        echo "<center>";
        
            echo  'Vol : '.$don->vol. '<br /><br />';
            echo  'Nom : '.$don->nomClient.' '.$don->prenomClient.'<br />';
            echo  'Départ : '.$don->date_dep.' - '.$don->heure_dep.'<br />';
            echo  'Arrivée : '.$don->date_arr.' - '.$don->heure_arr.'<br />';
            echo  'Prix par place HT : '.$don->prixPlace.' €<br><br>';
            
            echo form_open('manager/controleUpdateResa/'.$don->rsr_num.'');
            echo form_label('Nombre de places :', 'places');
            $value= array('name'=>'places','id'=>'places');
            echo form_input($value);
            
            echo '<br /><br />';
            
            echo form_submit('envoi', 'Modifier');
            echo form_reset('reset', 'Effacer');
            echo form_close();
            
            echo '<br />';
            
            echo '<a class="stylebouton" href="'. base_url().'index.php/manager/affichageDesReservations/'.$don->rsr_num.'">Retour</a>';
            
            echo '<br /><br /><br /><br /><br />';
            
            endforeach;
            
        echo '</div>';
        echo '</div>';    
        echo '</center>';
        
            $this->load->view('foot');?>

    </body>
    
  <script>
    $( document ).ready(function() {
      console.log( "ready to show reservations!" );
      $( "#menu_res" ).addClass('active');
    });
  </script>
  
</html>