<?php
    namespace app\controllers;
    use app\services\AuthService;
    use Exception;
    use app\controllers\localStorage;
    use app\helpers\Request;

    require_once __DIR__ . '/../services/AuthService.php';

    class AuthController
    {
        private AuthService $authService;

        public function __construct()
        {
            $this->authService = new AuthService();
        }

        public function login()
        {
            try {

                $email = Request::input('email');
                $password = Request::input('password');

                if (!$email || !$password) {
                http_response_code(400);
                echo json_encode([
                'status' => false,
                'message' => 'Email and password are required'
                ]);
                return;
                };
                $result = $this->authService->login(
                    $email, $password
                );
                echo json_encode($result);
            } catch (Exception $e) {
                http_response_code(401);
                echo json_encode([
                    "error" => $e->getMessage()
                ]);
            }
        }

        public function register()
        {
            //$data = json_decode(file_get_contents("php://input"), true);
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email address');
            }
            if (strlen($_POST['password']) < 8) {
                throw new Exception('Password must be at least 8 characters');
            }

            if (!preg_match('/[A-Z]/', $_POST['password'])) {
                throw new Exception('Password must contain at least one uppercase letter');
            }

            if (!preg_match('/\d/', $_POST['password'])) {
                throw new Exception('Password must contain at least one number');
            }
            if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
                throw new Exception("Invalid input");
            }

            echo json_encode($this->authService->register($_POST));
        }
    }
