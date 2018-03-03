<?php session_start();?>
<!DOCTYPE html>
<html>
<?php include_once('../views/head.php')?>
<?php include_once("../model/model.php")?>


  <body>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<form name="retour" action="../views/login.php" method="post">
<?php

$mess_err = "Vous avez oublié de remplir le champs : ";
$mess_err_saisie = $mess_err;
$message_err_login="";
$message_err_mdp="";

if(!empty($_POST)){

if(empty($_POST["login"])){
$mess_err_saisie= $mess_err_saisie."'Login'";
$message_err_login=$mess_err."'Login'";
}

if(empty($_POST["motDePasse"])){
$mess_err_saisie=$mess_err_saisie."'Mot de passe'";
$message_err_mdp=$mess_err."'Mot de passe'";
}

if (strlen($mess_err_saisie) > strlen($mess_err)){


  if (strlen($message_err_login) > strlen($mess_err)){?><center><div class="alert alert-danger">
<b>Erreur!</b> <?php echo $message_err_login."<br />" ?></div></center> <?php ;}
  if (strlen($message_err_mdp) > strlen($mess_err)){?><center><div class="alert alert-danger">
<b>Erreur!</b> <?php echo $message_err_mdp."<br />" ?></div></center> <?php ;}
}

else {
$message = "";
$salutation="";
$nom=$_POST["login"];
$mdp=$_POST["motDePasse"];
$_SESSION["nom"]= $nom;


$reponse = getAgences();

$ref = false;

  foreach($reponse as $key => $value) {
  if( $value["code_agence"]==$nom && $value["mot_de_passe"]==$mdp )
  $ref = true;
}
if($ref==true){
    header("Location: ../views/home.php");
  /*  echo '<div class="alert alert-success">
    <b>Félicitation! vous etes connecté</b>
  </div>'*/ ;
}
else{
  header("Location: ../views/login.php");
/*  echo '<div class="alert alert-danger">
<b>erreur de connection</b>
</div>';*/

}

}
}

?>

<center><input type="submit" value="Accueil"></center>
</form>

  <?php include_once('../views/foot.php')?>
  </body>
</html>
