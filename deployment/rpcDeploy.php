<?php

require __DIR__ . '/../config.php';
require __DIR__ .'/dbConn.class.php';

$doDeploy = function ($arr) {

  //scp the bundle over to Production
  //send Production a message saying Bundle was copied
  //receive message from Production and send message to Dev

   
};

$server = new Thumper\RpcServer($registry->getConnection());
$server->initServer('doDeploy');
$server->setCallback($doDeploy);
$server->start();
