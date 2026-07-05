<?php

echo "cURL : ";

var_dump(function_exists('curl_init'));

echo "<br><br>";

$ch = curl_init("https://api.binderbyte.com");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

echo "<pre>";

var_dump($response);

echo "</pre>";

echo "Error : ";

echo curl_error($ch);

curl_close($ch);