
<div id="menu" class="row">
    <div class="col-lg-12">

        <nav class="navbar navbar-default">
          <ul class="nav navbar-nav">
              <li id="menu_home"> <a href="<?php echo site_url()?>/?action=home"><span class="glyphicon glyphicon-home"></span>   Accueil </a> </li>
              <li id="menu_cat" > <a href="<?php echo site_url()?>/manager/affichageDesVols"><span class="glyphicon glyphicon-plane"></span>    Liste des vols</a> </li>
              <li id="menu_res" > <a href="<?php echo site_url()?>/manager/affichageDesReservations"><span class="glyphicon glyphicon-edit"></span>   Réservations</a> </li>
              
          </ul>
          <form method="POST" action=<?php echo site_url_logout()?> >
              
            <div class="deco">
              <button type="submit" class="btn btn-default navbar-btn">Déconnexion</button>
            </div>
              <div class="loginAgence">
                  <ul class="nav navbar-nav">
                      <li id="loginAgence"><a><span class=""></span><?php echo "[agence ".$_SESSION["login"]."]"; ?></a></li>
                  </ul>
              </div>
          </form>
        </nav>

  </div>
</div>
