<?php

namespace Dzion;

use Dzion\Interfaces\RequestInterface;
use Dzion\Interfaces\ResponseInterface;
use Dzion\Interfaces\RouterInteface;

class Application
{
    protected $router;
    protected $request;
    protected $response;

    public function __construct(RouterInteface $router,
                                RequestInterface $request,
                                ResponseInterface $response) {
        $this->router   = $router;
        $this->request  = $request;
        $this->response = $response;
    }

    public function run() : ResponseInterface {

        $route = $this->router->init();

        $response = $this->runController($route);

        return $response;
    }

    protected function runController($route) {

            $class      = $route->namespace . $route->controller;
            // $class      = APP_CONTROLLERS_NAMESPACE . "{$route->controller}";
            $arguments  = $route->arguments;
            $action     = $route->action;

            // $class = "Dzion\\Services\\NotPageController";

            if(!class_exists($class))
                throw new \Exception(
                    "Not Found Controller-'{$class}' "
                );

            $controller = new $class;

            if (!method_exists($controller, $action))
                throw new \Exception(
                    "Not Found Action -'{$action}' "
                );

            if(!empty($arguments)) {

                $args = array();
                foreach ($arguments as $key => $value)
                    $args[] = $value;

                $response = $controller->$action(...$args);
            } else {
                $response = $controller->$action();
            }

            $this->response->init($response, []);

            return $this->response;
    }

}

