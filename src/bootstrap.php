<?php

// use Dzion\Core\BaseConstants;
use Dzion\Core\Container;
use Dzion\Core\Database;
use Dzion\Core\Request;
use Dzion\Core\Response;
use Dzion\Core\Router;

$container = new Container();

// Получаем конфиг базы
$dbConfig = require_once ROOT_DIR . 'config/dbconfig.php';
$db        = new Database($dbConfig);

$request   = new Request();
$router    = new Router();
$response  = new Response();

// Получаем routes
require_once ROOT_DIR . 'config/routes.php';

// Заполняем DI Container
$container->set('email-validate', Dzion\Services\EmailValidate::class);

// Файл для ручного тестирования
require_once ROOT_DIR . 'src/Helpers/dev_test.php';

