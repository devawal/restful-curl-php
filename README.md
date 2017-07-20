Restful CURL for PHP application

### Install

It's recommended that you use [Composer](https://getcomposer.org/) to install Slim.

```bash
$ composer require devawal/restful-curl
```

### Description

```php
object|array RestCurl::get(string $url, array $parameters, boolean $json_post, array $header, boolean $object)
```

### Parameters

url
    Request URL
    
parameters
    Request parameters
    
json_post
    If the request parameters is json
    
header
    Request with header
    
object
    If response needs to be object

### Usage

```php
require 'vendor/autoload.php';

use RestfullCurl\RestCurl;

$response = RestCurl::get('https://jsonplaceholder.typicode.com/posts');
```
