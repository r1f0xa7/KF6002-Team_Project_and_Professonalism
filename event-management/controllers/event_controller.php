<?php
require_once '../config/database.php';
require_once '../models/Event.php';

$eventModel = new Event($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Admin check
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
        flash('unauthorized_action', 'You are not authorized to perform this action', 'alert alert-danger');
        redirect('views/events/event_list.php');
        exit();
    }

    if (isset($_POST['delete_event'])) {
        $event_id = sanitize($_POST['event_id']);
        if ($eventModel->deleteEvent($event_id)) {
            flash('event_deleted', 'Event deleted successfully');
        } else {
            flash('event_delete_fail', 'Failed to delete event', 'alert alert-danger');
        }
        redirect('views/events/event_list.php');
    }

    // Handle event creation
    if (isset($_POST['create_event'])) {
        $title = sanitize($_POST['title']);
        $date = sanitize($_POST['date']);
        $time = sanitize($_POST['time']);
        $location = sanitize($_POST['location']);
        $description = sanitize($_POST['description']);

        if ($eventModel->createEvent($title, $date, $time, $location, $description)) {
            flash('event_created', 'Event created successfully');
        } else {
            flash('event_create_fail', 'Failed to create event', 'alert alert-danger');
        }
        redirect('views/events/event_list.php');
    }

    // Handle event editing
    if (isset($_POST['edit_event'])) {
        $event_id = sanitize($_POST['event_id']);
        $title = sanitize($_POST['title']);
        $date = sanitize($_POST['date']);
        $time = sanitize($_POST['time']);
        $location = sanitize($_POST['location']);
        $description = sanitize($_POST['description']);

        if ($eventModel->updateEvent($event_id, $title, $date, $time, $location, $description)) {
            flash('event_updated', 'Event updated successfully');
        } else {
            flash('event_update_fail', 'Failed to update event', 'alert alert-danger');
        }
        redirect('views/events/event_list.php');
    }
}
