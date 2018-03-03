<?php session_start();?>
<!DOCTYPE html>
<?php include_once("head.php");?>
<html>
<body>
  <div class="top">
  <center>  <img src="../img/banniere.png" alt="logo"></center>
  </div>
<div id = "formulaireConnexion">
      <br />
      <form  method = "POST" action="../controller/traitementConnexion.php">
      <center>  <fieldset id = "connexion">
          <legend> Connexion </legend>
            <label class="inline">Login : </label>
              <input type="text" name="login" size="30"/>
            <label class="inline">   Mot de passe : </label>
              <input type="password" name="motDePasse" size="30"/>
        </fieldset></center>
        <p>
        <center>  <input type="submit" value="Connexion">
          <input type="reset" value="Effacer"></center>

        </p>
      </form>
</div>
<?php include_once("foot.php");?>
</body>
