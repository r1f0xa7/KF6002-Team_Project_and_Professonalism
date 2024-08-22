<?php include(__DIR__.'/../../includes/header.php'); ?>
<?php
$event = $eventModel->getEventById($_GET['id']);
?>
<div class="container">
    <h2>Edit Event</h2>
    <form action="../controllers/event_controller.php" method="POST">
        <div class="form-group">
            <label for="title">Event Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo $event['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" rows="5" required><?php echo $event['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" value="<?php echo $event['date']; ?>" required>
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" name="time" class="form-control" value="<?php echo $event['time']; ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" class="form-control" value="<?php echo $event['location']; ?>" required>
        </div>
        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
        <button type="submit" name="update_event" class="btn btn-success">Update Event</button>
    </form>
</div>
<?php include(__DIR__.'/../../includes/footer.php'); ?>
