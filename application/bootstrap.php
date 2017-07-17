<?php

// Require functions normally
require '../support/helpers.php';

function __autoload($class)
{
    $path = "../libs/{$class}.php";
    if (!file_exists($path)) {
        throw new Exception("The {$class}.php could not be found!");
    }
    require $path;
}