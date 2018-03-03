<?php session_start();?>
<?php
include_once("../model/model.php");
include_once("../model/Pdf.php");
include_once("util.php");

function getReservationTable($aRequest=array()) {
  //
  $result = getReservations($aRequest);
  //
  if(!is_array($result))
    return $result; // null or error message
  //
  //--------------------------- add buttons
  foreach($result as $k=>$v) {
    $aAction = array();
    $aAction[] = '<button type="button"
                        class="btn btn-default btn-sm" onclick="editRes('.$v['gnc_id'].', '.$v['rsr_num'].')">
    <span class="glyphicon glyphicon-pencil"></span>
  </button>&nbsp;';
    $aAction[] = '<button type="button"
                         class="btn btn-default btn-sm" onclick="deleteRes('.$v['gnc_id'].', '.$v['rsr_num'].')" >
    <span class="glyphicon glyphicon-trash"></span>
  </button>&nbsp;';
    $aAction[] = '<button type="button"
                         class="btn btn-default btn-sm" onclick="getPdf('.$v['gnc_id'].', '.$v['rsr_num'].')">
    <span class="glyphicon glyphicon-file"></span>
  </button>&nbsp;';
    //
    unset($result[$k]['gnc_id']);
    unset($result[$k]['rsr_num']);
    //
    $result[$k]['&nbsp;'] = implode( '&nbsp;', $aAction);
  }
  //
  return mkHtmlTable($result);
}

if(isset($_REQUEST['action'])) {
  switch($_REQUEST['action']) {
    case 'getList':
      echo getReservationTable($_REQUEST);
      exit();
      break;
    //
    case 'getFly':
      $aRes =getReservation([':gnc_id' => $_REQUEST['gnc_id'],
        ':rsr_num' => $_REQUEST['rsr_num']]);
      //
      echo json_encode($aRes);
      exit();
      break;
    //
    case 'getPdf':
      //var_dump($_REQUEST);
      $aRes = getReservation([':gnc_id' => $_REQUEST['gnc_id'],
        ':rsr_num' => $_REQUEST['rsr_num']]);
      //      
      mkPdf($aRes);
      //
      exit();
      break;
    //
    case 'getFlyRes':
      $aRes =getVolRes([':vlg_num' => $_REQUEST['vlg_num'],
        ':date_dep' => $_REQUEST['date_dep']]);
      //
      echo json_encode($aRes);
      exit();
      break;
      //
    case 'update':
      $aRes = updateReservation([':gnc_id' => $_REQUEST['gnc_id'],
        ':rsr_num' => $_REQUEST['rsr_num'],
        ':nbr_places_res' => $_REQUEST['nbr_places_res']]);
      //
      echo getReservationTable();
      exit();
      break;
      //
    case 'delete':
      $aRes = deleteReservation([':gnc_id' => $_REQUEST['gnc_id'],
        ':rsr_num' => $_REQUEST['rsr_num']]);
      //
      echo getReservationTable();
      exit();
      break;
      //
    case 'add':
      $aParams = [':cln_id' => $_REQUEST['cln_id'],
      ':date_dep' => $_REQUEST['date_dep'],
      ':vlg_num' => $_REQUEST['vlg_num'],
      ':nbr_places_res' => $_REQUEST['nbr_places_res']];
      //
      $aRes = addReservation($aParams);
      //
      //echo getReservationTable();
      exit();
      break;
      //
    case 'getClients':
      echo json_encode(getClients(), true);
      exit();
      break;
      /*$aParams = ['prenom' => 'Bob',
                  'nom' => 'Soleteo',
                  'adr_cp' => 75019,
                  'adr_rue' => 'Rue des Chats',
                  'adr_ville' => 'Paris'];*/

    case 'addClient':
        $aParams = [':prenom' => $_REQUEST['prenom'],
        ':nom' => $_REQUEST['nom'],
        ':adr_cp' => $_REQUEST['adr_cp'],
        ':adr_rue' => $_REQUEST['adr_rue'],
        ':adr_ville' => $_REQUEST['adr_ville']];
        //
        $aRes = addClient($aParams);
        echo $aRes;
        exit();
        break;

  }
  //

}
else {
  header("Location: ../views/reservation.php");
}

?>
