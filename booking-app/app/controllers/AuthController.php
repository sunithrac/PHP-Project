<?php
    namespace app\controllers;
    use app\services\AuthService;
    use Exception;

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
//  $raw = file_get_contents("php://input");
//         $json = json_decode($raw, true);
                $result = $this->authService->login(
                    $_POST['email'],
                    $_POST['password']
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

            if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
                throw new Exception("Invalid input");
            }

            echo json_encode($this->authService->register($_POST));
        }
    }
