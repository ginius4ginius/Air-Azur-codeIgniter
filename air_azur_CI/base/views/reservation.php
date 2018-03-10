<?php // session_start();?>
<!DOCTYPE html>
<html>
  <?php $this->load->view('head');?>
  <body>
    <div id="container">
      <?php $this->load->view('header');?>
      <br />
       <div id="reservation">
        Réservation
      </div>
        <div class="modal-body">
       
            
           <?php foreach($tab1e as $don):?>
      <br /><br />

            <div>
                Vol : <?php echo $don->vlg_num;?> <br />
              Départ : <?php echo $don->date_dep;?> <br />
              Arrivée : <?php echo $don->date_arr;?> <br />
            </div>
            <br>
            <div> Client :
                
                    <?php
                      // Parcours du tableau
                      echo '<select name="nom">',"\n";
                      echo '<option value="" selected></option>';
                      foreach($client as $don):
                          echo '<option value="'.$don->nom.'">'.$don->nom.' '.$don->prenom.'</option>';
                      endforeach;
                      
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
            <?php foreach($tab1e as $don):
            echo '<div> Prix HT :'. $don->prix.' euro</div>';
            endforeach;?>
            <input type="hidden" id="prix" />
            <input type="hidden" id="vlg_num" />
            <input type="hidden" id="date_dep" />
            <?php  endforeach;?>    
          </div>
        <?php echo '</div>';
$this->load->view('foot');?>
  </body>
  <script>
    $( document ).ready(function() {
      console.log( "ready to show catalog!" );
      $( "#menu_cat" ).addClass('active');
    });
  </script>
</html>