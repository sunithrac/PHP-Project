<?php
    namespace app\services;

    use app\repositories\DoctorRepository;
    use app\helpers\ConstantMessages;
    use PDO;
    use Exception;

    require_once __DIR__ . '/../repositories/DoctorRepository.php';
    require_once __DIR__ . '/../helpers/ConstantMessages.php';
    require_once __DIR__ . '/../config/Database.php';

    class DoctorService {

        private DoctorRepository $doctorRepo;

        public function __construct()
        {
            $db = \app\config\Database::connect();
            $this->doctorRepo = new DoctorRepository($db);
        }

        public function getDoctors()
        {
            return $this->doctorRepo->fetchAll();
        }
    }
?>