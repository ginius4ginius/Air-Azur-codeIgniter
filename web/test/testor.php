<?php
include_once('../model/model.php');
//

/*
$oDl = new DataLink();
$sQuery = "select * from auteur where nationalite = :nationalite";

$aRes = $oDl->getResultSet($sQuery, [':nationalite' => 'Russe']);
var_dump($aRes);
*/
//-------------------------------
//
echo '------------ test getClients<br>';
//
$aRes = getClients();
var_dump($aRes);
//-------------------------------
echo '------------ test getVols<br>';
$aRes = getVols();
var_dump($aRes);
//-------------------------------
echo '------------ test getVolGs<br>';
$aRes = getVolGs();
var_dump($aRes);
 ?>
