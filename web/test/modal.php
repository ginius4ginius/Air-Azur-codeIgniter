<div class="modal fade" id="ConfCoOk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        <br>
        <div class="alert alert-success">
          <b>Félicitation! vous etes connecté</b>
        </div>
        <br>
      </div>
      <div class="modal-footer">
        <form method="POST" action="views/home.php" >

        <input type="submit" value="Retour">
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ConfCoNo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        <br>
        <div class="alert alert-danger">
        <b>erreur de connection</b>
        </div
        <br>
      </div>
      <div class="modal-footer">
        <form method="POST" action="views/login.php" >

        <input type="submit" value="Retour">
        </form>
      </div>
    </div>
  </div>
</div>
