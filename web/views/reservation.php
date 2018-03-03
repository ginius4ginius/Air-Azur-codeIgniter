<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <?php include_once('head.php')?>
  <body>
    <div id="container">
      <?php include_once('header.php')?>
      <div>
        <br />
        <div id="listeResa">
          Liste des réservations
        </div>
        <br /><br />
        <form id="res_form" action="../controller/reservation.php" method="post">
          <input type="hidden" name="action" value="getPdf">
          <input type="hidden" name="gnc_id" id="idgnc">
          <input type="hidden" name="rsr_num" id="idrsr">
          <div id="reservation_list">
          </div>
        </form>
      </div>
    </div>
    <?php include_once('foot.php')?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Changer la réservation</h4>
          </div>
          <div class="modal-body">
            <div> Client : <span id="client"></span> </div>
            <br>
            <div>
              Vol: <span id="vol"></span> <br>
              Départ : <span id="depart"></span> <br>
              Arrivée : <span id="arrivee"></span> <br>
            </div>
            <br>
            <div> Nombre de places :
              <input type="number" min="1" id="nbPlaces" size="3" onchange="updatePrix(this.value)"/>
            </div>
            <br>
            <div> Prix HT : <span id="prix_calc"></span> &euro;</div>

            <input type="hidden" id="prix" />
            <input type="hidden" id="gnc_id" />
            <input type="hidden" id="rsr_num" />

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" onclick="updateRes()">Valider</button>
          </div>
        </div>
      </div>
    </div>

  </body>
  <script>

    function deleteRes(gnc_id, rsr_num) {
      console.log( "delete %s, %s", gnc_id, rsr_num );
      if(confirm("Voulez-vous vraiment supprimer cette réservation ?")) {
        console.log( "delete %s, %s", gnc_id, rsr_num );
        //
        $.ajax({ url : '../controller/reservation.php?action=delete',
          //type : "POST",
          data: { gnc_id : gnc_id, rsr_num : rsr_num },
          dataType : "html",
          success : function(data) {
            console.log( "ajax delete success");
            $("#reservation_list").html(data);
          },
          error : function(data) {
            console.log( "ajax delete error" );
            $("#reservation_list").html(" Ajax Error");
          }
        });
      }
    }
    //
    function updatePrix(iPlaces) {
      $("#prix_calc").html($("#prix").val() * iPlaces);
    }
    function updateRes() {
      console.log( "update %s, %s", $("#gnc_id").val(), $("#rsr_num").val() );
      $.ajax({ url : '../controller/reservation.php?action=update',
        //type : "POST",
        data: { gnc_id : $("#gnc_id").val(),
          rsr_num : $("#rsr_num").val(), nbr_places_res : $("#nbPlaces").val()  },
        dataType : "html",
        success : function(data) {
          console.log( "ajax update success");
          $("#reservation_list").html(data);
        },
        error : function(data) {
          console.log( "ajax update error" );
          $("#reservation_list").html(" Ajax Error");
        }
      });
      //
      $('#myModal').modal('hide');
    }

    function editRes(gnc_id, rsr_num) {
      console.log( "edit %s, %s", gnc_id, rsr_num );
      $.ajax({ url : '../controller/reservation.php?action=getFly',
        //type : "POST",
        data : { gnc_id : gnc_id, rsr_num : rsr_num },
        dataType : "json",
        success : function(data) {
          console.log("ajax success getFly %O", data);
          $("#client").html(data.client);
          $("#vol").html(data.vol);
          $("#depart").html(data.depart);
          $("#arrivee").html(data.arrivee);
          $("#nbPlaces").val(data.nbPlaces);
          $("#prix_calc").html(data.prix * data.nbPlaces);
          $("#prix").val(data.prix);
          $("#gnc_id").val(data.gnc_id);
          $("#rsr_num").val(data.rsr_num);
          //
          $('#myModal').modal();
        },
        error : function(data) {
          console.log( "ajax error getFly %O", data );
        }
      });

    }

    function getPdf(gnc_id, rsr_num) {
      console.log( "get pdf %s %s", gnc_id, rsr_num);
      $( "#idgnc" ).val(gnc_id);
      $( "#idrsr" ).val(rsr_num);
      $( "#res_form" ).submit();
    }

    $( document ).ready(function() {
      console.log( "ready to show reservations!" );
      $( "#menu_res" ).addClass('active');

      console.log( "getting reservations!" );
      //
      $.ajax({ url : '../controller/reservation.php?action=getList',
        //type : "POST",
        dataType : "html",
        success : function(data) {
          console.log( "ajax getList success");
          $("#reservation_list").html(data);
        },
        error : function(data) {
          console.log( "ajax getList error" );
          $("#reservation_list").html(" Ajax Error");
        }
      });
      //
    });

  </script>
</html>
