<?php 
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<?php  $this->load->view('head');?>
<html>
<body>
  <div class="top">
      <center>  <img src= <?php echo img_url('banniere.png'); ?> alt="logo"></center>
  </div>
<div id = "formulaireConnexion">
    
    <br/>
    <?php 
    
     echo form_open('clogin/controle');
     echo "<center>";
     echo form_fieldset('connexion');
     
            echo form_label('Login :', 'login');
            $login= array('name'=>'login','id'=>'login','value'=>set_value('login'));
            echo form_input($login);
            
            
            echo form_label('Mot de passe : ', 'motDePasse');
            $mdp= array('name'=>'motDePasse','id'=>'motDePasse');
            echo form_password($mdp);
    
            echo '<br />';
            echo form_error('login');
            echo form_error('motDePasse');
     
            echo form_submit('envoi', 'Connexion');
            echo form_reset('reset', 'Effacer');
            
     echo form_fieldset_close();
     echo '</center>';
     echo form_close();
     
    ?>
    <br/>
    
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
<?php $this->load->view('foot');?>
</body>
</html>
