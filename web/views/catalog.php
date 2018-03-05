<?php 
//session_start(); ?>
<!DOCTYPE html>
<html>

  <?php include_once('head.php')?>
  <body>
    <div id="container">
      <?php include_once('header.php')?>
      <div>
        <br />
        <div id="listeVols">
        Liste des vols
      </div>
      <br /><br />
        <!--
        <form action="../controller/catalog.php">
          <div>Afficher vols disponibles: </div>
        -->
          <!--contenu du formulaire à l'interieur -->
          <!--filtres du catalogue -->
          <!--
          <input type="submit" value="Valider">
        </form>
      -->
        <div id="fly_list">
          <?php include_once('../controller/catalog.php')?>


        </div>
      </div>
    </div>
    <?php include_once('foot.php')?>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Réserver un vol</h4>
          </div>
          <div class="modal-body">

            <div>
              Vol : <span id="vol"></span> <br>
              Départ : <span id="depart"></span> <br>
              Arrivée : <span id="arrivee"></span> <br>
            </div>
            <br>
            <div> Client :
              <select id="cln_id">
              </select>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button type="button" class="btn btn-primary btn-sm" onclick="showClientForm()">Ajouter client</button>
            </div>
            <br>
            <div> Nombre de places :
              <input type="number" min="1" id="nbPlaces" size="3" onchange="updatePrix(this.value)"/>
            </div>
            <br>
            <div> Prix HT : <span id="prix_calc"></span> &euro;</div>

            <input type="hidden" id="prix" />
            <input type="hidden" id="vlg_num" />
            <input type="hidden" id="date_dep" />

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" onclick="addRes()">Valider</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myClient" tabindex="-1" role="dialog" aria-labelledby="myClientLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myClientLabel">Ajouter un client</h4>
          </div>
          <div class="modal-body">

            <div>
              Nom : <br>
              <input id="cltNom" required />
            </div><br>

            <div>
              Prénom : <br>
              <input id="cltPrenom" required />
            </div><br>

            <div>
              Adresse - Rue : <br>
              <input id="cltRue" size="60" required />
            </div><br>

            <div>
              Adresse - Code postal : <br>
              <input id="cltCode" size="20" required />
            </div><br>

            <div>
              Adresse - Ville : <br>
              <input id="cltVille" size="50" required />
            </div><br>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" onclick="addNewClient()">Valider</button>
          </div>
        </div>
      </div>
    </div>

  </body>

  <script>


    function showClientForm() {
      // on vide tout
      $("#cltNom").val("");
      $("#cltPrenom").val("");
      $("#cltRue").val("");
      $("#cltCode").val("");
      $("#cltVille").val("");
      //
      $('#myClient').modal('show');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////
    function addNewClient() {
      console.log( "add client %s %s", $("#cltPrenom").val(), $("#cltNom").val() );
      $.ajax({ url : '../controller/reservation.php',
        type : "POST",
        data: { action : "addClient",
                nom : $("#cltNom").val(),
                prenom : $("#cltPrenom").val(),
                adr_rue : $("#cltRue").val(),
                adr_cp : $("#cltCode").val(),
                adr_ville : $("#cltVille").val() },
        //
        dataType : "html",
        success : function(data) {
          console.log( "add client success");
          getClientList();
        },
        error : function(data) {
          console.log( "add client error: %O", data );
          alert("Le client ne peut pas être ajouté");
        }
      });
      //
      $('#myClient').modal('hide');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////
    function updatePrix(iPlaces) {
      $("#prix_calc").html($("#prix").val() * iPlaces);
    }
    function addRes() {
      console.log( "add %s, %s", $("#vlg_num").val(), $("#date_dep").val() );
      $.ajax({ url : '../controller/reservation.php?action=add',
        //type : "POST",
        data: { cln_id : $("#cln_id").val(),
                vlg_num : $("#vlg_num").val(),
                date_dep : $("#date_dep").val(),
                nbr_places_res : $("#nbPlaces").val() },
        dataType : "html",
        success : function(data) {
          console.log( "ajax call success");
          alert("Le vol a bien été réservé ");
          location.reload();
        },
        error : function(data) {
          console.log( "ajax call error: %O", data );
          alert("Le vol ne peut pas être réservé");
        }
      });
      //
      $('#myModal').modal('hide');
    }

    function getClientList() {
      console.log("getClientList");
      $.ajax({ url : '../controller/reservation.php?action=getClients',
        //type : "POST",
        dataType : "json",
        success : function(data) {
          console.log( "clients: %O", data);
          // remove old options
          $('#cln_id').find('option').remove();
          //
          for(let i=0; i < data.length; i++) {
            console.log( "line obj %s: %O", i, data[i]);
            $('#cln_id').append('<option value="'+data[i].cln_id+'">'+data[i].prenom+' '+data[i].nom+'</option>');
          }
          //
        },
        error : function(data) {
          console.log( "Error clients: %O", data );
        }
      });
    }

    function showResForm(vlg_num, date_dep) {
      console.log( "add %s, %s", vlg_num, date_dep );
      //
      $("#vlg_num").val(vlg_num);
      $("#date_dep").val(date_dep);
      $("#nbPlaces").val(1);
      //
      getClientList();
      //
      $.ajax({ url : '../controller/reservation.php?action=getFlyRes',
        //type : "POST",
        data : { vlg_num : vlg_num, date_dep : date_dep },
        dataType : "json",
        success : function(data) {
          console.log( "getFlyRes success %O", data);
          //
          $("#vol").html(data.vol);
          $("#depart").html(data.depart);
          $("#arrivee").html(data.arrivee);
          //
          $("#prix_calc").html(data.prix);
          $("#prix").val(data.prix);
          //
          $('#myModal').modal();
        },
        error : function(data) {
          console.log( "getFlyRes error %O", data);
        }
      });

    }

    $( document ).ready(function() {
      console.log( "ready to show catalog!" );
      $( "#menu_cat" ).addClass('active');
    });
  </script>
</html>
