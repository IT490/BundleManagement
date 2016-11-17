<?php

require __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPLazyConnection;
use Thumper\ConnectionRegistry;

$connections = array(
    'default' => new AMQPLazyConnection('10.200.20.117', 5672, 'admin', 'admin')
  );

$registry = new ConnectionRegistry($connections, 'default');

