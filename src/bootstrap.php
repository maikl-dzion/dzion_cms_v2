<?php

// use Dzion\Core\BaseConstants;
use Dzion\Core\Container;
use Dzion\Core\Request;
use Dzion\Core\Response;
use Dzion\Core\Router;

//define("APP_CONTROLLERS_NAMESPACE", "Dzion\\App\\Controllers\\");
//define("SERVICES_NAMESPACE", "Dzion\\Services\\");

$container = new Container();

$request   = new Request();
$router    = new Router();
$response  = new Response();

// Получаем routes
require_once ROOT_DIR . 'config/routes.php';

// Заполняем DI Container
$container->set('email-validate', Dzion\Services\EmailValidate::class);

//$eValidate = $container->get('email-validate');
//$email = 'dzion67@mail.ru';
//$r = $eValidate->validate($email);
//print_r($r); die;

//$route = $router->init();
//
//print_r([$router, $route]);