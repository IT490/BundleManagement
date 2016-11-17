<?php

	require __DIR__ . '/config.php';

	//make thumper request to database to get latest version
	$requestForVersion = array();
	$requestForVersion['name'] = $argv[1];

	var_dump($requestForVersion);
	
	$client = new Thumper\RpcClient($registry->getConnection());
	$client->initClient();

	$client->addRequest(serialize($requestForVersion), 'doVersion', 'doVersion');

	//consume latest version
	$replies = $client->getReplies();
	$data = unserialize($replies["doVersion"]);
	//handle latest version - create new version number
	var_dump($data);
	$currentVersionNumber = $data['version']+ 1;
	echo $currentVersionNumber;
	//read config and save paths
	//create new bundle


	//request to deployment to pull new bundle

	//consume success message
