<?php 

// Homepage
$router->get("/", "HomeController@index");

// Products page
$router->get("/motors", "MotorController@index");
$router->get("/motors/(\d+)", "MotorController@show");


// Management page
$router->get("/manage", "ManageController@index");
// Motors
$router->get("/motors/create", "MotorController@create");
$router->post("/motors/store", "MotorController@store");
$router->post("/motors/delete", "MotorController@destroy");
$router->get("/motors/edit/(\d+)", "MotorController@edit");
$router->post("/motors/update", "MotorController@update");


// Types
$router->post("/types/store", "TypeController@store");
$router->post("/types/delete", "TypeController@destroy");
$router->post("/types/update", "TypeController@update");
