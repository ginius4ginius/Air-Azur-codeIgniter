<?php
include_once('../model/model.php');
//-------------------------------
echo '------------ test getResLastNum<br>';
$aRes = getResLastNum(1);
var_dump($aRes);
//
/*
//-------------------------------
echo '------------ test addReservation<br>';
$aParams = [':cln_id' => '3', 
            ':date_dep' => '2018-01-22',
            ':vlg_num' => 'AF410',
            ':nbr_places_res' => 1];
//
$aRes = addReservation($aParams);
var_dump($aRes);
*/
/*
//-------------------------------
echo '------------ test deleteReservation<br>';
$aParams = [':gnc_id' => '1', ':rsr_num' => '4']; 
//
$aRes = deleteReservation($aParams);
var_dump($aRes);
*/
echo '------------ test getVolRes<br>';
$aParams = [':vlg_num' => 'AF150', ':date_dep' => '2018-01-17']; 
//
$aRes = getVolRes($aParams);
var_dump($aRes);

echo '------------ test getReservation<br>';
$aParams = [':gnc_id' => '1', ':rsr_num' => '1']; 
//
$aRes = getReservation($aParams);
var_dump($aRes);
//-------------------------------
echo '------------ test getReservations<br>';
//
$aRes = getReservations();
var_dump($aRes);

?>
