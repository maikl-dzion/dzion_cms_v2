<?php
/**
 * Created by PhpStorm.
 * User: maikl
 * Date: 27.10.2020
 * Time: 15:52
 */

namespace Dzion\Core;

use Dzion\Interfaces\ContainerInterface;

class Container implements ContainerInterface
{

    protected $container = [];

    public function set($name, $resource = NULL)
    {
        if ($resource === NULL)
            $resource = $name;
        $this->container[$name] = $resource;
    }

    public function get(string $name, $params = [])
    {
        // if we don't have it, just register it
        if (!isset($this->container[$name]))
            $this->set($name);

        return $this->resolve($this->container[$name], $params);
    }

    public function has(string $key)
    {
        if(isset($this->container[$key]))
           return true;
        return false;
    }

    protected function resolve($resource, $parameters)
    {
        if ($resource instanceof \Closure)
            return $resource($this, $parameters);

        $reflect = new \ReflectionClass($resource);
        // check if class is instantiable
        if (!$reflect->isInstantiable())
            throw new \Exception("Class {$resource} is not instantiable");

        // get class constructor
        $constructor = $reflect->getConstructor();
        if (is_null($constructor)) // get new instance from class
            return $reflect->newInstance();

        // get constructor params
        $parameters   = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        // get new instance with dependencies resolved
        return $reflect->newInstanceArgs($dependencies);
    }


    protected function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            // get the type hinted class
            $dependency = $parameter->getClass();
            if ($dependency === NULL) {
                // check if default value for a parameter is available
                if ($parameter->isDefaultValueAvailable()) {
                    // get default value of parameter
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Can not resolve class dependency {$parameter->name}");
                }
            } else {
                // get dependency resolved
                $dependencies[] = $this->get($dependency->name);
            }
        }

        return $dependencies;
    }
}