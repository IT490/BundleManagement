<?php

	require __DIR__ . '/config.php';

	//make thumper request to database to get latest version
	$request = array();
	$request['name'] = $argv[1];

	$client = new Thumper\RpcClient($registry->getConnection());
	$client->initClient();
	$client->addRequest(serialize($request), 'doDeployReq', 'doDeployReq');

	//consume latest version
  $replies = $client->getReplies();
  echo "Requesting deployment of " . $argv[1] . " component...\n";
  $data = unserialize($replies["doDeployReq"]);

  if ( $data['status'] == "Success" ) {
    echo "Successfully deployed " . $argv[1] . " to Production environment...\n";
  }

  else { echo "Deployment failed!\n"; }
