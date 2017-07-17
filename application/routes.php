<?php

$route->get('/', function(){
    echo "Welcome!";
});
$route->get('about', function(){
    echo "About!";
});

$route->post('/', function(){
    echo "Recieved a post request";
});