<?php

namespace Dzion\Core;

use Dzion\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    // Protected
    protected $uri;
    protected $method;
    protected $server;

    // Public
    public $getData  = [];
    public $postData = [];

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    public function init()
    {
        $this->uri();
        $this->method();
        $this->setPostData();
    }

    protected function uri()
    {
        $this->uri = trim(
            parse_url($this->server['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    public function method()
    {
        $this->method = $this->server['REQUEST_METHOD'];
    }

    public function setPostData() {
        $post = (array)json_decode(file_get_contents('php://input'));
        if (!empty($post))
           $this->postData = $post;
    }

    public function postSlice(string $fieldName, $postData = []) {

        foreach ($postData as $key => $values) {
              $item = $postData[$key];
              if($fieldName == $key) {
                  return (array)$item;
              } elseif((is_array($item)) || (is_object($item))) {
                  $arr = $this->postSlice($fieldName, (array)$item);
                  if(!empty($arr))
                      return (array)$arr;
              }
        }

        return [];
    }

}
