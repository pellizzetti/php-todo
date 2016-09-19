<?php

class Router
{

    protected $routes = array();

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function run()
    {
        $reqUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $reqUri = trim($reqUri, '/\^$');

        $route = isset($this->routes[$reqUri]) ? $this->routes[$reqUri] : null;

        if ($route == null) {
            return die("Route $reqUri not found.");
        }

        if ($route instanceof Closure) {
            return call_user_func($route);
        }

        if (stripos($route, '@') !== false) {
            list($route, $method) = explode('@', $route);
            $hasMethod = true;
        }

        $controllersPath = 'controllers';
        if (!file_exists("{$controllersPath}/{$route}.php")) {
            return die("Controller $route not found.");
        }

        require_once "{$controllersPath}/{$route}.php";
        $controller = new $route;

        if (isset($hasMethod)) {
            $controller->$method();
        }

    }

}
