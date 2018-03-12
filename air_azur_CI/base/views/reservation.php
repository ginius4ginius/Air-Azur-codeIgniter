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
        <div class="modal-body">
       
            
           <?php foreach($tab1e as $don):?>
      <br /><br />

            <div>
                Vol : <?php echo $don->vlg_num;?> <br />
              Départ : <?php echo $don->date_dep;?> <br />
              Arrivée : <?php echo $don->date_arr;?> <br />
              Prix HT :<?php echo $don->prix.' €';?>
            </div>
            <br>
            <div> Client :
                
                    <?php
                      // Parcours du tableau
                      echo '<select name="nom">',"\n";
                      $tableClient;
                      echo '<option value="" selected></option>';
                      foreach($client as $don):
                          $tableClient = $don->nom;
                          echo '<option value="'.$don->nom.'">'.$don->nom.' '.$don->prenom.'</option>';
                      endforeach;
                      var_dump($tableClient);
                      echo '</select>';
                    ?>  
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button type="button" class="btn btn-primary btn-sm" onclick="showClientForm()">Ajouter client</button>
            </div>
            <br>
            <div> Nombre de places :
              <input type="number" min="1" id="nbPlaces" size="3" onchange="updatePrix(this.value)"/>
            </div>
            <br>
            <input type="hidden" id="prix" />
            <input type="hidden" id="vlg_num" />
            <input type="hidden" id="date_dep" />
            
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-default" OnClick="window.location.href=\'http://[::1]/Air-Azur_codeIgniter/air_azur_CI/index.php/manager/affichageDesVols\'">Valider</button>
            <?php  endforeach;?>    
          </div>
      
      
      
      
      
      
      <div id = "formulaireConnexion">
    
    <br/>
    <?php 
    
     echo form_open('manager/controleResa');
     echo "<center>";
     echo form_fieldset('');
     
        foreach($tab1e as $don):
           echo   'Vol : '.$don->vlg_num.' <br />';
           echo   'Départ : '.$don->date_dep.' <br />';
           echo   'Arrivée : '.$don->date_arr.' <br />';
           echo   'Prix HT : '.$don->prix.' € <br />';
            
        endforeach;
            
            echo '<br />';
            echo form_label('Nombre de places :  ', 'nbrPlaces');
            $nbrPlace= array('name'=>'nbrPlaces','id'=>'nbrPlaces','value'=>set_value('nbrPlaces'));
            echo form_input($nbrPlace);
    
            echo '<br />';
            echo form_error('nbrPlaces');
            echo '<br />';
            echo form_submit('envoi', 'Valider');
            echo form_reset('reset', 'Effacer');
            echo '<br /><br />';
            echo '<a class="stylebouton" href="'. base_url().'index.php/manager/affichageDesVols">Retour</a>';
            
     echo form_fieldset_close();
     echo '</center>';
     echo form_close();
     
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