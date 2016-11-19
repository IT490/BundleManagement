<?php

	require __DIR__ . '/config.php';

	//make thumper request to database to get latest version
	$requestForVersion = array();
	$requestForVersion['name'] = $argv[1];

	$client = new Thumper\RpcClient($registry->getConnection());
	$client->initClient();
	$client->addRequest(serialize($requestForVersion), 'doVersion', 'doVersion');

	//consume latest version
  $replies = $client->getReplies();
  echo "Requesting current version from Deployment server...\n";
	$data = unserialize($replies["doVersion"]);
	//handle latest version - create new version number
  $currentVersionNumber = $data['version']+ 1;
  echo "Creating a new bundle version...\n";
  //read config and save paths
  exec('mkdir tmp');
  $str = file_get_contents('config.json');
  $json = json_decode($str, true);
  foreach ($json[$argv[1]] as $elem){
    exec('cp ' . $elem . ' ~/bundleMgmt/tmp/');
  }
  //create new bundle
  echo "Bundling all components of " . $argv[1] . "...\n";


	//request to deployment to pull new bundle

	//consume success message
