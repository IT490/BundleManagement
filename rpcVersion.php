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
		var_dump($results);
    $msg['version'] = $results['version'];
    var_dump($msg);
		$data = serialize($msg);
		return $data;
  }
  else {
    return "No";
  }
   
};

$server = new Thumper\RpcServer($registry->getConnection());
$server->initServer('doVersion');
$server->setCallback($doVersion);
$server->start();
