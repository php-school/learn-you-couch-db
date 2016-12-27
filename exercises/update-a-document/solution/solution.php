<?php

use Doctrine\CouchDB\CouchDBClient;

require __DIR__ . '/vendor/autoload.php';

$client = CouchDBClient::create(['dbname' => $argv[1]]);
$doc = $client->findDocument($argv[2])->body;
$doc['cute_level'] = 10;

$client->putDocument($doc, $argv[2]);
