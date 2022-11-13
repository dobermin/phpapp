<?php

use app\Core\Route;

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . strtr($class, '\\', '/') . '.php';
    if (file_exists($file))
        require_once $file;
});

require_once __DIR__ . '/Core/Route.php';
require_once __DIR__ . '/../routes/web.php';

Route::start();