<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1/' . $argv[1]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_PORT, 5984);
curl_setopt($ch, CURLOPT_PUT, true);
$output = json_decode(curl_exec($ch), true);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);