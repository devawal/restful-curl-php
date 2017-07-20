<?php 

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use RestfullCurl\RestCurl;

$response = RestCurl::get('https://jsonplaceholder.typicode.com/posts');

var_dump($response);