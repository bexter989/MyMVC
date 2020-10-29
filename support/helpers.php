<?php

use libs\Load;

/**
 * Config wrapper
 * @return stdClass Populated with config items
 */
function config()
{
    $configs = require '../application/config.php';
    $obj     = new stdClass;
    foreach ($configs as $k => $v) {
        $obj->$k = $v;
    }
    return $obj;
}

/**
 * A Wrapper for the View Object
 * @param  string $view view file
 * @param  mixed|array $data data to pass to the view
 * @return View Object
 */
function view($view, $data = null)
{
    try {
        $load = new Load;
        $load->view($view, $data);
        return $load;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * Atempts to return an array index if it exists Will
 * return a default value if it is set or specified
 * via a third parameter
 * @param  mixed|array $array The array
 * @param  integer $index The key
 * @param  mixed $default The user supplied default value
 * @return mixed|array
 */
function ifExists($array, $index, $default = null)
{
    if (!isset($array[$index]) || $array[$index] === "") {
        return $default;
    }
    return $array[$index];
}
