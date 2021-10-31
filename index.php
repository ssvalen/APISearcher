<?php

header('Access-Control-Allow-Origin: *');

require_once('./controllers/Autoload.php');

$autoload = new Autoload();
$route = isset($_GET['r']) ? $_GET['r'] : 'home';
$panel = new Router($route);


?>