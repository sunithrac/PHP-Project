<?php
    namespace app\config;

    use PDO;
    use PDOException;
    use Exception;
    use app\helpers\ConstantMessages;

    require_once __DIR__ . '/../helpers/ConstantMessages.php';

    class Database
    {
        private static string $host = "localhost";
        private static string $db   = "doctor_app";
        private static string $user = "root";
        private static string $pass = "Root@123";

        private static ?PDO $conn = null;

        public static function connect(): PDO
        {
            if (self::$conn === null) {
                try {
                    self::$conn = new PDO(
                        "mysql:host=" . self::$host . ";dbname=" . self::$db,
                        self::$user,
                        self::$pass
                    );
                    self::$conn->setAttribute(
                        PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION
                    );
                } catch (PDOException $e) {
                    throw new Exception(ConstantMessages::CONNECTION_FAIL);
                }
            }

            return self::$conn;
        }
    }

?>