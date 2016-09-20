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

        foreach ($this->routes as $route => $callback) {

            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route)) . "$@D";

            if (preg_match($pattern, $reqUri, $match)) {

                array_shift($match);

                if ($callback instanceof Closure) {
                    return call_user_func_array($callback, $match);
                }

                list($callback, $method) = explode('@', $callback);

                $controllersPath = 'controllers';
                if (!file_exists("{$controllersPath}/{$callback}.php")) {
                    return die("Controller $callback not found.");
                }

                require_once "{$controllersPath}/{$callback}.php";
                $controller = new $callback;
                $controller->$method($match);

            }
        }

    }

}
