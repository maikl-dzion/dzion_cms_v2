<?php

use Dzion\Core\Request;
use Dzion\Core\Router;

$request = new Request();
$router  = new Router();

require_once ROOT_DIR . 'config/routes.php';

define("APP_CONTROLLERS_NAMESPACE", "Dzion\\App\\Controllers\\");

//$route = $router->init();
//
//print_r([$router, $route]);