<?php

use Doctrine\CouchDB\CouchDBClient;

require __DIR__ . '/vendor/autoload.php';

$client = CouchDBClient::create(['dbname' => $argv[1]]);
$doc = $client->findDocument($argv[2]);
$client->deleteDocument($argv[2], $doc->body['_rev']);
