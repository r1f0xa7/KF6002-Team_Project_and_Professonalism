<?php include(__DIR__.'/../../includes/header.php'); ?>
<div class="container">
    <h2>Create New Event</h2>
    <form action="../controllers/event_controller.php" method="POST">
        <div class="form-group">
            <label for="title">Event Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" name="time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <button type="submit" name="create_event" class="btn btn-success">Create Event</button>
    </form>
</div>
<?php include(__DIR__.'/../../includes/footer.php'); ?>
