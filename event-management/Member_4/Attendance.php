<?php
class Attendance {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function registerAttendance($userId, $eventId) {
        // Check if the user is already registered
        $sql = "SELECT * FROM attendance WHERE user_id = :user_id AND event_id = :event_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId, ':event_id' => $eventId]);
        if ($stmt->fetch()) {
            return false; // User already registered
        }

        // Register attendance
        $sql = "INSERT INTO attendance (user_id, event_id) VALUES (:user_id, :event_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':event_id' => $eventId,
        ]);
    }

    public function getEventAttendance($eventId) {
        $sql = "SELECT COUNT(*) AS attendee_count FROM attendance WHERE event_id = :event_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':event_id' => $eventId]);
        return $stmt->fetch()['attendee_count'];
    }

    public function hasUserAttended($userId, $eventId) {
        $sql = "SELECT * FROM attendance WHERE user_id = :user_id AND event_id = :event_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId, ':event_id' => $eventId]);
        return $stmt->fetch();
    }
    public function attendEvent($user_id, $event_id) {
        $sql = "INSERT INTO attendance (user_id, event_id) VALUES (:user_id, :event_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':user_id' => $user_id, ':event_id' => $event_id]);
    }
}
