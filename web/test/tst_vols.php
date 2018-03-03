<?php
include_once('../model/model.php');
include_once('../controller/util.php');
//
//-------------------------------
//-------------------------------
echo '------------ test getVols<br>';
function getVolTable() {
$aRes = getVols();
//var_dump($aRes);
foreach($aRes as $k=>$v) {
  $aAction = array();
  $aAction[] = '<button type="button"
                      class="btn btn-default btn-sm" onclick="editRes('.$v['vlg_num'].')">
  <span class="glyphicon glyphicon-file"></span>
</button>&nbsp;';
  //
  unset($aRes[$k]['vlg_num']);
  //
  $aRes[$k]['&nbsp;'] = implode( '&nbsp;', $aAction);
}

return mkHtmlTable($aRes);
}

echo getVolTable();
//-------------------------------
/*
echo '------------ test getVolGs<br>';
$aRes = getVolGs();
var_dump($aRes);
*/
?>
