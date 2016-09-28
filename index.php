<?php

if (!session_id()) {
    session_start();
}

require 'routes/Router.php';
$routes = require 'routes/routes.php';

$router = new Router($routes);

$router->run();
