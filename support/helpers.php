<?php

function config()
{
    $configs = require '../application/config.php';
    $obj = new stdClass;
    foreach ($configs as $k => $v)
    {
        $obj->$k = $v;
    }
    return $obj;
}