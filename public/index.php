<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('ROOT_DIR', __DIR__ . '/../');

require ROOT_DIR . '/vendor/autoload.php';

require ROOT_DIR . '/src/bootstrap.php';

use Dzion\Application;

try {

    $app = new Application($router,$request);

    $app->run();

} catch (\Exception $e) {

    echo $e->getMessage();

}


