<?php

    namespace app\repositories;
    use PDO;
    use DateTime;

    class DoctorRepository {
        private $db;

        public function __construct() {
            $this->db = \app\config\Database::connect();
        }

        public function fetchAll()
        {
            $stmt = $this->db->query(
                "SELECT d.id, d.name, d.specialization,
                        d.available_from, d.available_to
                FROM doctors d"
            );
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>