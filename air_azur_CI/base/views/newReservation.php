<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
  <?php $this->load->view('head');?>
  <body>
    <div id="container">
      <?php $this->load->view('header');?>
      <br />
       <div id="reservation">
        Nouvelle Réservation
      </div>
      <div id = "formulaireConnexion">
    
    <br/><br />
    <?php 
    foreach($tab1e as $don):
            $vdata=$don->date_dep;
    endforeach;
    foreach($client as $don):
        //probleme de génération de la liste des clients car écrase les nom identiques
                    $tableDesClients[$don->nom] = $don->nom.' '.$don->prenom;
                    endforeach;
                    //  var_dump($tableDesClients);
     echo form_open('manager/controleResa/'.$vdata);
     echo "<center>";
     echo form_fieldset('');
     
        foreach($tab1e as $don):
            $vdata=$don->date_dep;
           echo   'Vol : '.$don->vlg_num.' <br />';
           echo   'Départ : '.$don->date_dep.' <br />';
           echo   'Arrivée : '.$don->date_arr.' <br />';
           echo   'Prix HT : '.$don->prix.' € <br />';
            
        endforeach;
            
            echo '<br />';
            echo form_dropdown('nom', $tableDesClients);
            echo '<a class="stylebouton" href="'. base_url().'index.php/manager/ajouterClient/'.$don->date_dep.'">Nouveau client</a>';
            echo '<br /><br />';
            
            echo form_label('Nombre de places :  ', 'nbrPlaces');
            $nbrPlace= array('name'=>'nbrPlaces','id'=>'nbrPlaces','value'=>set_value('nbrPlaces'));
            echo form_input($nbrPlace);
            echo form_error('nbrPlaces');
            
            echo '<br /><br />';
            
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