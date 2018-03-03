<?php
//
$sLocation = "views/login.php"; //default location route
//
//--------------------------------------- route
if(isset($_REQUEST['action'])) {
  switch($_REQUEST['action']) {
    case 'reservation':
      $sLocation = "controller/reservation.php";
      break;
    //
    case 'catalog':
      $sLocation = "views/catalog.php";
      break;
    //
    case 'home':
      $sLocation = "views/home.php";
      break;
  }
}


//----------- go to location
header("Location: $sLocation");
//exit();
//
 ?>
