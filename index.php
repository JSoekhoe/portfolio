<?php

$App = require 'database/private.php';
$dbconn = $App['database'];


$routes = [
    "/" => "controllers/home.php",
    "/about" => "controllers/about.php",
    "/login" => "controllers/login.php",

];

if(array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
} else {
    echo " ERROR 404";
}

