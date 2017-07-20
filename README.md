Restful CURL for PHP application

### Install

It's recommended that you use [Composer](https://getcomposer.org/) to install restful-curl-php

```bash
$ composer require devawal/restful-curl
```

### Description

```php
object|array RestCurl::get(string $url, array $parameters, boolean $json_post, array $header, boolean $object)
```

### Parameters

* url: Request URL
    
* parameters: Request parameters
    
* json_post: If the request parameters is json
    
* header: Request with header
    
* object: If response needs to be object

### Usage

```php
require 'vendor/autoload.php';

use RestfullCurl\RestCurl;

// Get request
$response = RestCurl::get('https://jsonplaceholder.typicode.com/posts');

// Post request
$response = RestCurl::post('https://jsonplaceholder.typicode.com/posts');

// Post request with parameters and header
$param = array(
                'grant_type'=>'password', 
                'client_secret'=>'s5df5d6f6d6f', 
              );
$header = array('Accept: application/json', 'Authorization: Bearer df98df665df6d8f8');
$response = RestCurl::post('https://jsonplaceholder.typicode.com/posts', $parameters, true, $header);

// Put request
$response = RestCurl::put('https://jsonplaceholder.typicode.com/posts/1');

// Patch request
$response = RestCurl::patch('https://jsonplaceholder.typicode.com/posts/1');

// Delete request
$response = RestCurl::delete('https://jsonplaceholder.typicode.com/posts/1');
```
