<?php

use Dzion\Core\BaseConstants;
use Dzion\Core\Request;
use Dzion\Core\Response;
use Dzion\Core\Router;

//define("APP_CONTROLLERS_NAMESPACE", "Dzion\\App\\Controllers\\");
//define("SERVICES_NAMESPACE", "Dzion\\Services\\");

$request  = new Request();
$router   = new Router( BaseConstants::APP_CONTROLLERS_NAMESPACE);
$response = new Response();

require_once ROOT_DIR . 'config/routes.php';


//$route = $router->init();
//
//print_r([$router, $route]);