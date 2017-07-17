<?php
require '../support/helpers.php';
// require '../libs/Error.php';
// require '../libs/Load.php';
// require '../libs/Controller.php';
// require '../libs/Model.php';
// require '../libs/Request.php';
// require '../libs/Router.php';

function __autoload($class)
{
    $path = "../libs/{$class}.php";
    if (!file_exists($path)) {
        throw new Exception("The {$class}.php could not be found!");
    }
    require $path;
}