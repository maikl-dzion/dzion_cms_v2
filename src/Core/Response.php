<?php
/**
 * Created by PhpStorm.
 * User: maikl
 * Date: 24.10.2020
 * Time: 18:19
 */

namespace Dzion\Core;


use Dzion\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    protected $data;
    protected $param;

    public function init($data, $param = [])
    {
        $this->data = $data;
        $this->param = $param;
    }

    public function getResponse() {
        print_r($this->data); die;
    }
}
