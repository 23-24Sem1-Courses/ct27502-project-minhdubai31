<?php 

// Homepage
$router->get("/", "HomeController@index");

// Products page
$router->get("/motors", "MotorController@index");
$router->get("/motors/create", "MotorController@create");
$router->get("/motors/show", "MotorController@show");

// Management page
$router->get("/manage", "ManageController@index");