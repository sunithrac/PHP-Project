<?php
    namespace app\repositories;
    use PDO;
    use DateTime;

    class UserRepository {
        private $db;

        public function __construct() {
            $this->db = \app\config\Database::connect();
        }

        public function findByEmail(string $email) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function createPatient(array $data)
        {

            $stmt = $this->db->prepare(
                "INSERT INTO users (name,email,mobileno,address,gender,age,password)
                VALUES (?,?,?,?,?,?,?)"
            );
            $stmt->execute([
                $data['name'],
                $data['email'],
                $data['mobileno'],
                $data['address'],
                $data['gender'],
                $data['age'],
                $data['password'],
            ]);

            return ["message" => "Patient registered"];
        }

    }
?>