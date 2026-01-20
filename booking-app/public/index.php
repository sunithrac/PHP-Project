<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET");

    define('BASE_PATH', dirname(__DIR__));

    require_once BASE_PATH . '/app/routes/api.php';
?>