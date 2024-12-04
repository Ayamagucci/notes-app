<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

// triggered when PHP encounters class that hasn't been explicitly loaded yet
spl_autoload_register(function ($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  // dd($class); // "Core/Database"

  require base_path("{$class}.php");
});

require base_path('Core/router.php');
