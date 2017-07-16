<?php

$route->get('/', function(){
    echo "Welcome!";
});
$route->post('/', function(){
    echo "Recieved a post request";
});