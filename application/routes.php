<?php

$route->get('/', function(){
    $title = "Welcome page";
    return view('pages/home', compact('title'));
});

$route->get('about', 'PagesController@about');

$route->get('login', 'loginController@index');
$route->post('login', 'loginController@login');

$route->post('/', function(){
    echo "Recieved a post request";
});