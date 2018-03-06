<?php // session_start();?>
<!DOCTYPE html>
<html>
  <?php $this->load->view('head');?>
  <body>
    <div id="container">
      <?php $this->load->view('header');?>
      <div>
        <div id="accueil">

          <br />

          <div id="titreAccueil">
            Bienvenue sur l'intranet d'AIR AZUR
          </div>

          <br />

          <div id="textAccueil">
            <br /><br /><br />
            À propos d’Air Azur
            <br />  <br />
  Air Azur est l'un des plus importants transporteur aérien Français spécialisé dans les voyages vacances. Chaque année, la société transporte environ 3 millions de passagers vers près de 3 destinations dans 3 pays à l’aide d’une flotte de gros porteurs Airbus. La société emploie environ 2 personnes. Air Azur est une filiale de CDI A.A. inc., un voyagiste international intégré qui compte plus de 2 pays de destination et qui distribue des produits dans plus de 3 pays. Air Azur a été nommée meilleure ligne aérienne vacances en Amérique du Nord lors de la remise de prix annuelle des World Airline Awards organisée par Skytrax en juin 2015.
  <br />
  CDI A.A. inc. est un voyagiste international intégré qui compte plus de 2 pays de destination et qui distribue des produits dans plus de 3 pays. Spécialiste du voyage vacances, Transat est principalement active en France. CDI, dont le siège social est situé à Cachan, est aussi présente dans le transport aérien, l’hôtellerie.
  <br />
  Chez CDI, nous reconnaissons que l'environnement, les collectivités qui accueillent les voyageurs, la diversité culturelle et nos relations avec nos employés, clients et partenaires sont d'une importance capitale. Voilà pourquoi CDI a adopté une politique de responsabilité d’entreprise en 2008. De plus, Air Azur s’engage à réduire son empreinte écologique et a adopté une politique environnementale.
          </div>
          

        </div>

      </div>

    </div>
    <?php $this->load->view('foot');?>
  </body>
  <script>
    $( document ).ready(function() {
      console.log( "home and ready!" );
      $( "#menu_home" ).addClass('active');
    });
  </script>
</html>
