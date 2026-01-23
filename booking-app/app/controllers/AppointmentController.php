<?php
    namespace app\controllers;
    use app\core\Response;
    use app\services\AppointmentService;
    use Exception;
    use App\Core\AuthMiddleware;
    use app\helpers\ConstantMessages;

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
                $service = new AppointmentService();
                $service->bookAppointment($_POST);

                Response::json([
                    "status" => "success",
                    "message" => ConstantMessages::AppOINTMENT_SUCCESS
                ]);

            } catch (Exception $e) {
                Response::error($e->getMessage(), 400);
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