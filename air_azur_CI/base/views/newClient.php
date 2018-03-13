<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
  <?php $this->load->view('head');?>
  <body>
    <div id="container">
      <?php $this->load->view('header');
      /*
      foreach($tab1e as $don):
           echo   'Vol : '.$don->vlg_num.' <br />';
           echo   'Départ : '.$don->date_dep.' <br />';
           echo   'Arrivée : '.$don->date_arr.' <br />';
           echo   'Prix HT : '.$don->prix.' € <br />';
        endforeach;
       */
      
        ?>
        <br />
        <div id="reservation">
        Nouveau client
        </div>
        <br /><br />
      <div id = "formulaireConnexion">
    
    <?php
          //var_dump($table);
    foreach($table as $don):
           $vdata=$don->date_dep;
        endforeach;
          //  var_dump($vdata);
     echo form_open('manager/controleClient/'.$vdata);
     echo "<center>";
     echo form_fieldset('');
            
            echo form_label('Nom :  ', 'nom');
            $nom= array('name'=>'nom','id'=>'nom','value'=>set_value('nom'));
            echo form_input($nom);
            echo form_error('nom');
            echo '<br /><br />';
            echo form_label('Prenom :  ', 'prenom');
            $Prenom= array('name'=>'prenom','id'=>'prenom','value'=>set_value('prenom'));
            echo form_input($Prenom);
            echo form_error('prenom');
            echo '<br /><br />';
            echo form_label('Adresse :  ', 'adr_rue');
            $adr_rue= array('name'=>'adr_rue','id'=>'adr_rue','value'=>set_value('adr_rue'));
            echo form_input($adr_rue);
            echo form_error('adr_rue');
            echo '<br /><br />';
            echo form_label('Code postal :  ', 'adr_cp');
            $adr_cp= array('name'=>'adr_cp','id'=>'adr_cp','value'=>set_value('adr_cp'));
            echo form_input($adr_cp);
            echo form_error('adr_cp');
            echo '<br /><br />';
            echo form_label('Ville :  ', 'adr_ville');
            $adr_ville= array('name'=>'adr_ville','id'=>'adr_ville','value'=>set_value('adr_ville'));
            echo form_input($adr_ville);
            echo form_error('adr_ville');
            echo '<br /><br /><br />';
            
            echo form_submit('envoi', 'Valider');
            echo form_reset('reset', 'Effacer');
            echo '<br /><br />';
            echo '<a class="stylebouton" href="'. base_url().'index.php/manager/affichageDesVols">Retour</a>';
            
     echo form_fieldset_close();
     echo '</center>';
     echo form_close();
      echo '</div>';    
    echo '</div>';     
      
echo '</div>';
$this->load->view('foot');?>
  </body>
  <script>
    $( document ).ready(function() {
      console.log( "ready to show catalog!" );
      $( "#menu_cat" ).addClass('active');
    });
    
    function updatePrix(iPlaces) {
      $("#prix_calc").html($("#prix").val() * iPlaces);
    }
  </script>
</html>