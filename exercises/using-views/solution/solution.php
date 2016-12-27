<?php

use Doctrine\CouchDB\CouchDBClient;

require __DIR__ . '/vendor/autoload.php';

$client = CouchDBClient::create(['dbname' => $argv[1]]);

$query = $client->createViewQuery('animals', 'armoured');
$query->setReduce(false);

$result = $query->execute();

foreach ($result as $row) {
    printf("Name: %s \n", $row['value']);
}