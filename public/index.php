<?php

ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

require '../application/bootstrap.php';

try {
    new Router(new Request);
} catch (Exception $e) {
    echo $e->getMessage();
}

// TODO: Make all exceptions call a error class to show errors properly instead of echoing out onto the screen