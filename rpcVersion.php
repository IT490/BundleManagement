<?php

require __DIR__ . '/config.php';
require __DIR__ .'/dbConn.class.php';

$doVersion = function ($arr) {
  try {
    $data = unserialize($arr);
    $db = dbConn::getConnection();
    $sql = $db->prepare('SELECT * FROM Bundles WHERE name = :name AND Latest = TRUE');
    $sql->execute( array( ':name' => $data['name'] ) );
    $results = $sql->fetch();
  } catch ( PDOException $e ){
    echo $e->getMessage();
  }
  if ($results) {
    //login successful
    $msg = array();
    $msg['version'] = $results['version'];
		$data = serialize($msg);
		return $data;
  }
  else {
    //if no result that means bundle has never been bundled before
    //so, return 0 as version
    $msg = array();
    $msg['version'] = 0;
    $data = serialize($msg);
    return $data;
  }
   
};

$server = new Thumper\RpcServer($registry->getConnection());
$server->initServer('doVersion');
$server->setCallback($doVersion);
$server->start();
