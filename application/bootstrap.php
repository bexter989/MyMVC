<?php

use libs\Router;
use libs\Request;

// Require functions normally
require '../vendor/autoload.php';

try{
    $router = new Router(new Request);
    $router->dispatch();
}catch (Exception $ex) {
    echo $ex->getMessage();
}

