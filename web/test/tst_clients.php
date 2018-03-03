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
/*
echo '------------ test addClient<br>';
//
$aParams = ['nom' => 'Bob', 
            'prenom' => 'Dino',
            'adr_cp' => 75014,
            'adr_rue' => 'Rue des Oiseaux',
            'adr_ville' => 'Paris'];

$aParams = ['prenom' => 'Bob',
            'nom' => 'Soleteo',             
            'adr_cp' => 75019,
            'adr_rue' => 'Rue des Chats',
            'adr_ville' => 'Paris'];

$aRes = addClient($aParams);
var_dump($aRes);
*/
/*
echo '------------ test deleteClient<br>';
$aRes = deleteClient([':cln_id' => '6']);
var_dump($aRes);
*/
echo '------------ test getClients<br>';
//
$aRes = getClients();
var_dump($aRes);
 ?>
