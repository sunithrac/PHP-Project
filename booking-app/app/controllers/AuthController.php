<?php
class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['email'], $data['password'])) {
            http_response_code(400);
            echo json_encode(["message" => "Email and password required"]);
            return;
        }

        $result = $this->authService->login(
            $data['email'],
            $data['password']
        );

        echo json_encode($result);
    }
}

?>