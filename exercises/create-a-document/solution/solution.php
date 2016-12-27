<?php

use Doctrine\CouchDB\CouchDBClient;

require __DIR__ . '/vendor/autoload.php';

$client = CouchDBClient::create(['dbname' => $argv[1]]);
$client->postDocument(['data' => 'ftw', '_id' => 'phpschool']);

