<?php include(__DIR__.'/../../includes/header.php');


require_once(__DIR__.'/../../models/Attendance.php');

$attendanceModel = new Attendance($pdo);
$event = $eventModel->getEventById($_GET['id']);
$attendeeCount = $attendanceModel->getEventAttendance($_GET['id']);
$userHasAttended = $attendanceModel->hasUserAttended($_SESSION['user_id'], $_GET['id']);
?>
<div class="container">
    <h2><?php echo $event['title']; ?></h2>
    <p><?php echo nl2br($event['description']); ?></p>
    <p>Date: <?php echo $event['date']; ?></p>
    <p>Time: <?php echo $event['time']; ?></p>
    <p>Location: <?php echo $event['location']; ?></p>
    <p>Attendees: <?php echo $attendeeCount; ?>/<?php echo MAX_ATTENDANCE; ?></p>

    <?php if (!$userHasAttended && $attendeeCount < MAX_ATTENDANCE): ?>
        <form action="../controllers/attendance_controller.php" method="POST">
            <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
            <button type="submit" name="attend_event" class="btn btn-primary">Attend Event</button>
        </form>
    <?php elseif ($userHasAttended): ?>
        <p class="text-success">You are attending this event.</p>
    <?php else: ?>
        <p class="text-danger">This event is fully booked.</p>
    <?php endif; ?>
</div>
<?php include(__DIR__.'/../../includes/footer.php'); ?>
