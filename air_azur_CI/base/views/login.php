<?php 
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
</div>
<?php $this->load->view('foot');?>
</body>
</html>
