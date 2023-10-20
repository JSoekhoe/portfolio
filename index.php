<?php



$routes = [
    "/" => "controllers/home.php",
    "/about" => "controllers/about.php",
    "/login" => "controllers/login.php",
    "/logout" => "controllers/logout.php",
    "/registration" => "controllers/registration.php",
    "/dashboard" => "controllers/dashboard.php",
    "/profile" => "controllers/profile.php",
    "/schoolprestaties" => "controllers/schoolprestaties.php",
    "/hobbies" => "controllers/hobbies.php",
    "/werkervaring" => "controllers/werkervaring.php",

];

if(array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
} else {
    echo " ERROR 404";
}

