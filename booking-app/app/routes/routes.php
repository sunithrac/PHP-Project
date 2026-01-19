<?php
require_once "../controllers/AuthController.php";

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === "/api/login" && $method === "POST") {
    $controller = new AuthController();
    $controller->login();
} else {
    http_response_code(404);
    echo json_encode(["message" => "API not found"]);
}
?>