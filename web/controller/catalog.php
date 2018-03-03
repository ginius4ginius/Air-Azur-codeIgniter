<?php
include_once('../model/model.php');
include_once('../controller/util.php');

function getVolTable(){
  $aRes = getVols();
  //var_dump($aRes);
  foreach ($aRes as $key => $value) {
    $aAction = array();
    $aAction[] = '<button type="button"
                    class="btn btn-default btn-sm" 
                    onclick="showResForm(\''.$value['Vol'].'\', \''.$value['date_dep'].'\')">
    <span class="glyphicon glyphicon-plus"></span> Réserver
  </button>&nbsp;';
    //
    unset($aRes[$key]['date_dep']);
    //
    $aRes[$key]['&nbsp;'] = implode('&nbsp;',$aAction);

  }
return mkHtmlTable($aRes);
}
/*
if(isset($_REQUEST['action'])) {
  switch($_REQUEST['action']) {
    case 'add':
      //header("Location: controller/catalog_add.php");
      break;
    //
    case 'catalog':

      break;
      //
  }
}
else {
  header("Location: ../views/catalog.php");
}
*/
echo getVolTable();
?>
