<?php

ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

require '../application/bootstrap.php';

$request = new Request;

echo $request->getParam(1);

var_dump($request);