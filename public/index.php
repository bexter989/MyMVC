<?php

use libs\Router;
use libs\Request;

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

require '../application/bootstrap.php';

$router = new Router(new Request);
$router->dispatch();

// TODO: Make all exceptions call a error class to show errors properly instead of echoing out onto the screen
