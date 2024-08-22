<?php include(__DIR__.'/includes/header.php');
include(__DIR__.'/../config/database.php');
include(__DIR__.'/../models/Event.php');

$eventModel = new Event($pdo); // Instantiate the Event model
$events = $eventModel->getEvents(); // Fetch all events
?>
<div class="container">
    <h2>Welcome to Rose Foundation Event Management</h2>
    <p>Here you can explore upcoming events, register for events, and much more. Check out the event calendar below to see what's happening!</p>
    
    <!-- Move the calendar lower on the page -->
    <div id="calendar"></div>
</div>

    <script>
    const events = <?php echo json_encode($events); ?>;
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            contentHeight: 600,
            events: events.map(event => ({
                title: event.title, // Assuming the event name is stored in the 'name' field
                start: event.date, // Assuming the event date is stored in the 'date' field
                url: 'event_details.php?id=' + event.id // Event details URL
            })),
            dateClick: function(info) {
                alert('Date: ' + info.dateStr);
            },
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault(); // prevents browser from following the URL in current tab
                }
            }
        });
        calendar.render();
    });
</script>
<?php include(__DIR__.'/includes/footer.php'); ?>
