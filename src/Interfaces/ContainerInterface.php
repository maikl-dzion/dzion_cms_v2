<?php
/**
 * Created by PhpStorm.
 * User: maikl
 * Date: 24.10.2020
 * Time: 18:03
 */

namespace Dzion\Interfaces;


interface ContainerInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key, $params = []);

    public function has(string $key);

}
