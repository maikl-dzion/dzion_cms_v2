<?php

namespace Dzion;

use Dzion\Interfaces\RequestInterface;
use Dzion\Interfaces\ResponseInterface;
use Dzion\Interfaces\RouterInteface;
use Dzion\Core\Response;


class Application
{
    protected $router;
    protected $request;

    public function __construct(RouterInteface $router,
                                RequestInterface $request) {
        $this->router = $router;
        $this->request = $request;
    }

    public function run() : ResponseInterface {

        $route = $this->router->init();

        $response = $this->initController($route);

        print_r([$route, $response]);

        $response = new Response();

        return $response;
    }

    protected function initController($route) {

            $class      = APP_CONTROLLERS_NAMESPACE . "{$route->controller}";
            $arguments  = $route->arguments;
            $action     = $route->action;

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
                // $args = implode(',', $arguments);

                $args = array();
                foreach ($arguments as $key => $value)
                    $args[] = $value;

                $response = $controller->$action(...$args);
            } else {
                $response = $controller->$action();
            }

            return $response;
    }

}

