<?php
    namespace app\controllers;
    use app\services\DoctorService;
    use Exception;

    require_once __DIR__ . '/../services/DoctorService.php';

    class DoctorController {
        private DoctorService $doctorService;

        public function __construct()
        {
            $this->doctorService = new DoctorService();
        }

        public function list() {
            try {
                $doctors = $this->doctorService->getDoctors();
                echo json_encode($doctors);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(["error" => $e->getMessage()]);
            }        
        }
    }
?>