<?php

namespace Core;



class Router
{
    private $request;
    private $allowed_routes = array('ProductsController');
    private $controller, $id, $requestMethod;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->controller = $this->request->controller;
        $this->id = $this->request->id;
        $this->requestMethod = $this->request->requestMethod;


        $controller = $this->pullInController();

        switch ($this->requestMethod) {
            case 'GET':
                if ($this->id) {
                    $controller->show($request);
                } else {
                    $controller->index();
                };
                break;
            case 'POST':
                $controller->store();
                break;
            case 'PUT':
                $controller->update($request);
                break;
            case 'DELETE':
                $controller->delete($request);
                break;
            default:
                header('HTTP/1.1 404 Not Found');
                break;
        }
    }

    public function pullInController()
    {
        $controllerName = $this->controller;
        $outputFormat = '\\App\\Formats\\' . ucfirst($this->request->format);
        $outputFormat = new $outputFormat();

        if (in_array($controllerName, $this->allowed_routes)) {

            $controllerName = '\\App\\Controllers\\' . $controllerName;

            return new $controllerName($this->request, $outputFormat);
        } else {
            header('HTTP/1.1 404 Not Found');
            exit();
        }
    }

    public static function redirect($location)
    {
        if (!headers_sent()) {
            header('Location: ' . ROOT . $location);
            exit();
        } else {
            echo "<script type='text/javascript'>";
            echo "window.location.href='" . ROOT . $location . "'";
            echo "</script>";
            echo "<noscript>";
            echo "<meta http-equiv='refresh' content='0;url=" . $location . "'/>";
            echo "<noscript>";
            exit();
        }
    }
}
