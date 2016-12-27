<?php

use Doctrine\CouchDB\CouchDBClient;
use Doctrine\CouchDB\HTTP\Response;

require __DIR__ . '/vendor/autoload.php';

function printDoc($doc) {
    printf("Animal: %s, Armour Level: %d, Cute Level: %d\n", $doc['_id'], $doc['armour_level'], $doc['cute_level']);
}

$client  = CouchDBClient::create(['dbname' => $argv[1]]);
$allDocs = $client->allDocs();

foreach ($allDocs->body['rows'] as $doc) {
    printDoc($doc['doc']);
}

printf("My favourite armoured animal is: %s\n",  $client->findDocument($argv[2])->body['_id']);



