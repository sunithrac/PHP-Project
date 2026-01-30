<?php
    namespace app\controllers;
    use app\core\Response;
    use app\services\AppointmentService;
    use Exception;
    use App\Core\AuthMiddleware;
    use app\helpers\ConstantMessages;
    use DateTime;

    require_once __DIR__ . '/../services/AppointmentService.php';
    require_once __DIR__. '/../core/AuthMiddleware.php';

    class AppointmentController {

        private AppointmentService $appointmentService;
        private $userId;

        public function __construct()
        {
            $this->appointmentService = new AppointmentService();
            $this->userId = AuthMiddleware::authenticate();
        }

        public function bookAppointment()
        {
           if (
            empty($_POST['doctor_id']) ||
            empty($_POST['appointment_date']) ||
            empty($_POST['appointment_time'])
            ) {
                Response::error("Invalid input", 422);
                return;
            }

            try {
                $doctorId = (int)$_POST['doctor_id'];
                $date = $_POST['date'];
                $time = $_POST['time'];

                // Date validation
                $dateObj = DateTime::createFromFormat('Y-m-d', $date);
                if (!$dateObj || $dateObj->format('Y-m-d') !== $date) {
                    throw new Exception('Invalid date');
                }

                if ($dateObj < new DateTime('today')) {
                    throw new Exception('Date cannot be past');
                }

                // Time validation
                if (!DateTime::createFromFormat('H:i', $time)) {
                    throw new Exception('Invalid time');
                }

                $this->appointmentService->bookAppointment($_POST);

                echo json_encode(['status' => 'success']);

            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        public function cancel()
        {
            try {
                if (!isset($_POST['appointment_id'])) {
                    http_response_code(400);
                    echo json_encode(["error" => ConstantMessages::APPOINTMENT_ID]);
                    return;
                }

                $this->appointmentService->cancel(
                    $_POST['user_id'],
                    $_POST['appointment_id']
                );

                echo json_encode(["message" => ConstantMessages::APPOINTMENT_CANCEL]);

            } catch (\Exception $e) {
                http_response_code(401);
                echo json_encode(["error" => $e->getMessage()]);
            }
        }

        public function history()
        {
            try {

                $appointments = $this->appointmentService->history($this->userId);

                echo json_encode([
                    "data" => $appointments
                ]);

            } catch (\Exception $e) {
                http_response_code(401);
                echo json_encode(["error" => $e->getMessage()]);
            }
        }
    }
?>