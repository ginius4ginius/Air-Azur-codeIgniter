<?php
class DataLink {
  //--------------------------------------------------------------- members
  public $aDbConnector = array('dsn' => 'mysql:host=localhost;dbname=air_azur;charset=UTF8',
    'user' => 'root',
    'password' => '');
  //
  public $oConnection = null;
  //
  //--------------------------------------------------------------- methods
  //
  function  dbConnect() {
    $oPdo = null;
    //
    try {
      $oPdo = new PDO($this->aDbConnector['dsn'],
        $this->aDbConnector['user'],
        $this->aDbConnector['password']);
    }
    catch(Exception $e) {
      die('Erreur : '.$e->getMessage());
    }
    //
    return $oPdo;
  }
  // ---------------------------------------------------- single connection
  function getConnection() {
    if (!$this->oConnection)
      $this->oConnection = $this->dbConnect();
    //
    return $this->oConnection;
  }
  //
  function getResultSet($sQuery, $aParams=array()) {
    $aResultSet = array();
    //
    if ($oCnx = $this->getConnection()) {
      $oStm = $oCnx->prepare($sQuery);
      //
      //var_dump($oStm);
      if (!is_array($aParams))
        $aParams = [];
      //
      if($oStm->execute($aParams)) {
        $aResultSet = $oStm->fetchall(PDO::FETCH_ASSOC);
      }

    }
    //
    return $aResultSet;
  }
  //
  //
  function query($sQuery, $aParams=array()) {
    if ($oCnx = $this->getConnection()) {
      $oStm = $oCnx->prepare($sQuery);
      //
      if (!is_array($aParams))
        $aParams = [];
      //
      return $oStm->execute($aParams);
    }
    //
    return false;
  }
}
 ?>
