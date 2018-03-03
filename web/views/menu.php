
<div id="menu" class="row">
    <div class="col-lg-12">

        <nav class="navbar navbar-default">
          <ul class="nav navbar-nav">
              <li id="menu_home"> <a href="../index.php?action=home"><span class="glyphicon glyphicon-home"></span>   Accueil </a> </li>
              <li id="menu_cat" > <a href="../index.php?action=catalog"><span class="glyphicon glyphicon-plane"></span>    Liste des vols</a> </li>
              <li id="menu_res" > <a href="../index.php?action=reservation"><span class="glyphicon glyphicon-edit"></span>   Réservations</a> </li>
          </ul>
          <form method="POST" action="../controller/logout.php" >
            <div class="deco">
              <button type="submit" class="btn btn-default navbar-btn">Déconnexion</button>
            </div>
          </form>
        </nav>

  </div>
</div>
