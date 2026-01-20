<?php
    header("Content-Type: application/json");

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $uri = str_replace('/booking-app/public', '', $uri);

    $method = $_SERVER['REQUEST_METHOD'];

    use app\controllers\AuthController;
    use app\controllers\DoctorController;

    require_once __DIR__ . '/../controllers/AuthController.php';
    require_once __DIR__ . '/../controllers/DoctorController.php';

    if ($uri === '/api/login' && $method === 'POST') {
        $controller = new AuthController();
        $controller->login();
    } else if ($uri === '/api/register' && $method === 'POST') {
        $controller = new AuthController();
        $controller->register();
    } else if ($uri === '/api/doctors' && $method === 'GET') {
        $controller = new DoctorController();
        $controller->list();
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
    }

?>