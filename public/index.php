<?php

// (CLI): "php -S localhost:3000 -t public"

const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'Core/util.php';

// triggered when PHP encounters class that hasn't been explicitly loaded yet
spl_autoload_register(function ($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  // dd($class); // "Core\Database" —> "Core/Database"

  require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new \Core\Router();

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
