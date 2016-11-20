<?php

require __DIR__ . '/config.php';
require __DIR__ .'/dbConn.class.php';

$doBundle = function ($arr) {
  try {
	  $data = unserialize($arr);
    $db = dbConn::getConnection();
    $sql = $db->prepare('UPDATE Bundles SET Latest=FALSE WHERE Latest=TRUE AND name = :name');
		$sql->execute( array( ':Latest' => $data['Latest'] ) );
		$sql = $db->prepare('INSERT INTO Bundles (name, version, Latest) VALUES (:name, :version, TRUE');
		$sql->execute( array( ':name' => $data['name']);
		$results = $sql->fetch();
  } catch ( PDOException $e ){
    echo $e->getMessage();
  }
  if ($results) {
    //login successful
		echo "Checking to see if I have the latest version";
    $msg = array();
		//var_dump($results);
    $msg['version']=['version'];
   	// var_dump($msg);
		$data = serialize($msg);
		echo "Congrats, you have bundled successfully";
		return $data;
  }
  else {
    return "No";
  }
   
};

$server = new Thumper\RpcServer($registry->getConnection());
$server->initServer('doBundle');
$server->setCallback($doBundle);
$server->start();

//Assuming RSA keys are installed on each server (grab from dev server)
//exec('scp -P 11000 jason@hostadress:/home/jason/BundleMgmt/bundleRequest.php');
