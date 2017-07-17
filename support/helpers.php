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

function view($view, $data = null)
{
    $load = new Load;
    $load->view($view, $data);
    return $load;
}