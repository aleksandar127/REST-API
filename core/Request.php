<?php

namespace Core;

class Request
{

    public $controller;
    public $id = null;
    public $requestMethod;
    public $format = "Json";

    public function __construct()
    {

        $url = $_SERVER['REQUEST_URI'];
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
        $parts_of_url = explode('/', $url);
        array_shift($parts_of_url);
        $this->controller = ucfirst($parts_of_url[2]) . "Controller";
        if (isset($parts_of_url[3]))
            $this->id = is_numeric($parts_of_url[3]) ? $parts_of_url[3] : null;
        if (isset($parts_of_url[4]) && !empty($parts_of_url[4]))
            $this->format = $parts_of_url[4];
        elseif (!$this->id && isset($parts_of_url[3]) && !empty($parts_of_url[3]))
            $this->format = $parts_of_url[3];
    }
}

//   localhost/domen/api/products/2/json
//               0    1     2     3   4