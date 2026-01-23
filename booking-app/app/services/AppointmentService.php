<?php
    namespace app\services;

    use app\repositories\AppointmentRepository;
    use app\helpers\ConstantMessages;
    use PDO;
    use Exception;

    require_once __DIR__ . '/../repositories/AppointmentRepository.php';
    require_once __DIR__ . '/../helpers/ConstantMessages.php';
    require_once __DIR__ . '/../config/Database.php';

    class AppointmentService {

        private AppointmentRepository $appointmentRepo;

        public function __construct()
        {
            $db = \app\config\Database::connect();
            $this->appointmentRepo = new AppointmentRepository($db);
        }

        public function bookAppointment(array $data)
        {
            return $this->appointmentRepo->create($data);
        }

        public function cancel(int $userId, int $appointmentId): void
        {
            $this->appointmentRepo->cancel($userId, $appointmentId);
        }

        public function history(int $userId): array
        {
            return $this->appointmentRepo->history($userId);
        }
    }
?>