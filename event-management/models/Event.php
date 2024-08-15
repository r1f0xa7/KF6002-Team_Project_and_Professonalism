<?php
class Event {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function createEvent($title, $description, $date, $time, $location) {
        $sql = "INSERT INTO events (title, description, date, time, location) VALUES (:title, :description, :date, :time, :location)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':date' => $date,
            ':time' => $time,
            ':location' => $location,
        ]);
    }

    public function getEvents() {
        $sql = "SELECT * FROM events";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventById($id) {
        $sql = "SELECT * FROM events WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function updateEvent($id, $title, $description, $date, $time, $location) {
        $sql = "UPDATE events SET title = :title, description = :description, date = :date, time = :time, location = :location WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':date' => $date,
            ':time' => $time,
            ':location' => $location,
            ':id' => $id,
        ]);
    }

    public function deleteEvent($id) {
        $sql = "DELETE FROM events WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
