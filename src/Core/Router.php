<?php

namespace Dzion\Core;

use Dzion\Interfaces\RouterInteface;

class Router implements RouterInteface
{
    public    $routes = array();
    protected $requestUri;
    protected $phpSelf;
    protected $requestMethod;

    protected $arguments = array();
    protected $routeInfo = array();
    protected $namespace;
    protected $controller;
    protected $action;
    protected $route;

    public function __construct(string $controllerNamespace)
    {
       $this->requestUri = $_SERVER['REQUEST_URI'];
       $this->phpSelf    = $_SERVER['PHP_SELF'];
       $this->requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
       $this->namespace = $controllerNamespace;

    }

    public function init() : \stdClass
    {
        $this->findRoute();

        $route = new \stdClass();

        if(!$this->controller || !$this->action) {
            $this->controller = 'NotPageController';
            $this->action     = 'index';
            $this->arguments['message'] = 'Нет такого маршрута';
        }

        $route->arguments  = $this->arguments;
        $route->controller = $this->controller;
        $route->action     = $this->action;
        $route->routeInfo  = $this->routeInfo;
        $route->namespace  = $this->namespace;

        $this->route       = $route;

        return $this->route;
    }

    public function findRoute() {

        $curUriArr = $this->getReguestUri();
        $routes    = $this->getRoutes();
        $_count    = count($curUriArr);

        foreach ($routes as $uri => $param) {
            $route = explode('/', trim($uri, '/'));
            if(count($route) != $_count)
                continue;

            if($this->compareRoute($route, $curUriArr, $_count)) {

                 $paramArr =  explode('@', $param);
                 if(!empty($paramArr[0]))
                     $this->controller = $paramArr[0];

                if(!empty($paramArr[1]))
                    $this->action = $paramArr[1];
            }
        }
    }

    public function add($uri, $controller, $method = 'get') {
        $this->routes[$method][$uri] = $controller;
    }

    public function get($uri, $controller)
    {
        $this->add($uri, $controller, 'get');
    }

    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'post');
    }

    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'put');
    }

    protected function compareRoute($route, $curUriArr, $count) : bool {

        $parameters = array();
        $resultCount = 0;
        $routeCount  = 0;
        $argsCount   = 0;

        foreach ($route as $key => $value) {

            $findme = ':';
            $pos    = strpos($value, $findme);
            if ($pos !== false) {
                $param = str_replace($findme, "", $value);
                if(isset($curUriArr[$key])) {
                    $parameters[$param] = $curUriArr[$key];
                    $argsCount++;
                    continue;
                }
            }

            if(isset($curUriArr[$key]) && $curUriArr[$key] == $value) {
                $routeCount++;
            }
        }

        $resultCount = $routeCount + $argsCount;

        $routeInfo = array(
             'uri'         => $curUriArr,
             'route'       => $route,
             'all-count'   => $count,
             'route-count' => $routeCount,
             'args-count'  => $argsCount
        );

        if($resultCount == $count) {
            $this->routeInfo = $routeInfo;
            $this->arguments = $parameters;
            return true;
        }

        return false;
    }


    protected function getRoutes() : array {
        $methodName = $this->requestMethod;
        if($this->routes[$methodName])
            return $this->routes[$methodName];
        return array();
    }

    protected function getReguestUri() : array
    {
        $delimiter = '/';

        $uri   = explode($delimiter, rtrim(substr($this->requestUri, 1), $delimiter));
        $self  = explode($delimiter, rtrim(substr($this->phpSelf, 1), $delimiter));

        $resultUrl = array();

        foreach ($uri as $key => $value) {
            $stat = array_search($value, $self);
            if($stat === false)
                $resultUrl[] = $value;
        }

        return $resultUrl;
//        $currentUrl = $delimiter . implode($delimiter, $resultUrl);
//        return $currentUrl;
    }


}
