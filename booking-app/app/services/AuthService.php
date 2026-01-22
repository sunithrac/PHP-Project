<?php
    namespace app\services;

    use app\repositories\UserRepository;
    use app\helpers\ConstantMessages;
    use app\core\JWT;
    use PDO;
    use Exception;

    require_once __DIR__ . '/../repositories/UserRepository.php';
    require_once __DIR__ . '/../helpers/ConstantMessages.php';
    require_once __DIR__ . '/../config/Database.php';
    require_once __DIR__ . '/../core/JWT.php';

    class AuthService
    {
        private UserRepository $userRepo;

        public function __construct()
        {
            $db = \app\config\Database::connect();
            $this->userRepo = new UserRepository($db);
        }

        public function login(string $email, string $password): array
        {
            $user = $this->userRepo->findByEmail($email);

            if (!$user) {
                throw new Exception(ConstantMessages::USER_NOT_FOUND);
            }

            if (!password_verify($password, $user['password'])) {
                throw new Exception(ConstantMessages::INVALID_CREDENTIALS);
            }

            unset($user['password']);

            $payload = [
                "user_id" => $user['id'],
                "email"   => $user['email'],
                "exp"     => time() + (60 * 60) // 1 hour
            ];

            $token = JWT::encode($payload);

            return [
                "message" => "Login successful",
                "token"   => $token,
                "user"    => [
                    "id"    => $user['id'],
                    "name"  => $user['name'],
                    "email" => $user['email']
                ]
            ];
        }

        public function register(array $data)
        {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            return $this->userRepo->createPatient($data);
        }
    }

?>