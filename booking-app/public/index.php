<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);


    // CORS headers
    header("Access-Control-Allow-Origin: http://localhost:4200");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Credentials: true");

    // Handle preflight request
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
    }
    define('BASE_PATH', dirname(__DIR__));

    spl_autoload_register(function ($class) {
        $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    });

    require_once BASE_PATH . '/app/routes/api.php';
?>