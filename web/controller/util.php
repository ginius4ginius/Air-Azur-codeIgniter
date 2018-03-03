<?php
function mkHtmlTable($aTable) {
  $sHtml = null;
  //
  if(is_array($aTable)) {
    foreach($aTable as $k=>$v) {
      if(is_array($v)) {
        if($k == 0) {
          $aLabels = array_keys($v);
          $sHtml .= '<tr><th>'.implode('</th><th>', $aLabels).'</th></tr>';
        }
        //
        $sHtml .= '<tr><td>'.implode('</td><td>', $v).'</td></tr>';
      }
    }
  }
  //
  if(!empty($sHtml))
    $sHtml = "<table class=\"tpListTable\" > $sHtml </table>";
  //
  return $sHtml;
}

?>
