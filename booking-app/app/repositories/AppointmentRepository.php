<?php
    namespace app\repositories;
    use PDO;
    use DateTime;
    use app\helpers\ConstantMessages;

    class AppointmentRepository {

        private $db;

        public function __construct() {
            $this->db = \app\config\Database::connect();
        }

        public function create(array $data)
        {
            print_r($data);
            $sql = "
                INSERT INTO appointments
                (user_id, doctor_id, appointment_date, appointment_time, status)
                VALUES (:user_id, :doctor_id, :appointment_date, :appointment_time, :status)
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':user_id'   => $data['user_id'],
                ':doctor_id' => $data['doctor_id'],
                ':appointment_date'      => $data['appointment_date'],
                ':appointment_time'      => $data['appointment_time'],
                ':status'    => 'BOOKED'
            ]);
            // $stmt = $this->db->prepare(
            //     "INSERT INTO appointments
            //     (patient_id, doctor_id, appointment_date, appointment_time, status)
            //     VALUES (?,?,?,?,'BOOKED')"
            // );

            // $stmt->execute([
            //     $patient_id,
            //     $doctor_id,
            //     $appointment_date,
            //     $appointment_time,
            //     'Booked'
            // ]);

            return ["message" => ConstantMessages::BOOKING_MESSAGE];
        }

        public function cancel(int $userId, int $appointmentId): void
        {
            $stmt = $this->db->prepare(
                "UPDATE appointments 
                SET status = 'CANCELLED'
                WHERE id = ? AND user_id = ?"
            );
            $stmt->execute([$appointmentId, $userId]);
        }

        public function history(int $userId): array
        {
            $stmt = $this->db->prepare(
                "SELECT 
                    a.id,
                    d.specialization,
                    a.appointment_date,
                    a.appointment_time,
                    a.status
                FROM appointments a
                JOIN doctors d ON a.doctor_id = d.id
                WHERE a.user_id = ?
                ORDER BY a.appointment_date DESC"
            );
            $stmt->execute([$userId]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>