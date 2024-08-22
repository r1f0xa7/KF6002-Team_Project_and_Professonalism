<?php 
include(__DIR__.'/../../includes/header.php');
require_once(__DIR__.'/../../config/database.php'); // Import the database connection
require_once(__DIR__.'/../../models/Event.php'); // Import the Event model

$eventModel = new Event($pdo); // Instantiate the Event model

$events = $eventModel->getEvents(); // Fetch events using the model

// Check if the user is an administrator
$is_admin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
?>
<div class="container">
    <h2>Upcoming Events</h2>
    <?php flash('event_created'); ?>

    <!-- Only show the "Create New Event" button to administrators -->
    <?php if ($is_admin) : ?>
        <a href="create_event.php" class="btn btn-success mb-3">Create New Event</a>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['title']); ?></td>
                    <td><?php echo htmlspecialchars($event['date']); ?></td>
                    <td><?php echo htmlspecialchars($event['time']); ?></td>
                    <td><?php echo htmlspecialchars($event['location']); ?></td>
                    <td>
                        <?php if ($is_admin) : ?>
                            <a href="edit_event.php?id=<?php echo $event['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="../../controllers/event_controller.php" method="POST" style="display:inline;">
                                <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                <button type="submit" name="delete_event" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include(__DIR__.'/../../includes/footer.php'); ?>
