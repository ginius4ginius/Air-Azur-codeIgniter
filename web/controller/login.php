<?php session_start();?>
<?php  include_once("../model/model.php")?>
<?php

    $reponse = getAgences();
    $ref = false;

          foreach($reponse as $key => $value) {
          if( $value["code_agence"]== $_SESSION["nom"] ){$ref = true;}

          }


      /*    if($ref == true){
            header("Location: ../views/home.php");
          }
          else {
            header("Location: ../views/login.php");
          }*/
  ?>
