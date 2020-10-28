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

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        // TODO: Implement get() method.
    }

    public function has(string $key)
    {
        // TODO: Implement has() method.
    }
}