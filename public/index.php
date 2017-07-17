<?php

ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

require '../application/bootstrap.php';

$request = new Request;
$route = new Router($request);

var_dump($route);