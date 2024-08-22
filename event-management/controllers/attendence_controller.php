<?php
require_once '../config/database.php';
require_once '../models/Attendance.php';

session_start();

if (!isLoggedIn()) {
    redirect('login.php');
}

$attendanceModel = new Attendance($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['attend_event'])) {
        $userId = $_SESSION['user_id'];
        $eventId = sanitize($_POST['event_id']);

        if ($attendanceModel->registerAttendance($userId, $eventId)) {
            flash('attendance_registered', 'You are now attending this event');
        } else {
            flash('attendance_failed', 'Failed to register attendance, you might already be registered or the event is full', 'alert alert-danger');
        }

        redirect('event_details.php?id=' . $eventId);
    }
}
