<?php

$route->get('/', function(){
    $title = "Welcome page";
    return view('home/home_v', compact('title'));
});
$route->get('about', 'PagesController@about');

$route->post('/', function(){
    echo "Recieved a post request";
});