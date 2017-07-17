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
    try {
        $load = new Load;
        $load->view($view, $data);
        return $load;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}