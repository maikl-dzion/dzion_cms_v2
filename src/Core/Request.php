<?php

namespace Dzion\Core;

use Dzion\Interfaces\RequestInterface;

class Request implements RequestInterface
{

    public function init()
    {
        // TODO: Implement init() method.
    }

    /**
     * Fetch the request URI.
     *
     * @return string
     */
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    /**
     * Fetch the request method.
     *
     * @return string
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }


}
