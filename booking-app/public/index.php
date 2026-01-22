<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET");

    define('BASE_PATH', dirname(__DIR__));

    spl_autoload_register(function ($class) {
        $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    });

    require_once BASE_PATH . '/app/routes/api.php';
?>