<?php 
require_once __DIR__ . '/vendor/autoload.php';


// Dotenv
Dotenv\Dotenv::createImmutable(__DIR__)->load();


// Illuminate Database
$manager = new Illuminate\Database\Capsule\Manager;

$manager->addConnection([
    'driver' => $_ENV['DB_DRIVER'],
    'host' => $_ENV['DB_HOST'],
    'database' => $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
]);

$manager->setAsGlobal();
$manager->bootEloquent();




