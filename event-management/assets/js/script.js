$(document).ready(function () {
    // Check if dark mode was previously enabled
    if (localStorage.getItem('darkMode') === 'enabled') {
        $('body').addClass('dark-mode');
        $('#modeSwitch').text('Switch to Light Mode');
    }

    // Toggle dark mode on button click
    $('#modeSwitch').click(function () {
        $('body').toggleClass('dark-mode');

        if ($('body').hasClass('dark-mode')) {
            $('#modeSwitch').text('Switch to Light Mode');
            localStorage.setItem('darkMode', 'enabled'); // Save preference to localStorage
        } else {
            $('#modeSwitch').text('Switch to Dark Mode');
            localStorage.setItem('darkMode', 'disabled'); // Save preference to localStorage
        }
    });

    // Real-time event registration status update using AJAX
    $('.attend-event').click(function (e) {
        e.preventDefault();
        let eventId = $(this).data('id');
        $.ajax({
            url: '../controllers/event_controller.php',
            type: 'POST',
            data: { event_id: eventId, action: 'attend_event' },
            success: function (response) {
                // Assuming the response is a JSON object
                response = JSON.parse(response);
                if (response.status === 'success') {
                    alert('You are now attending this event!');
                    location.reload();
                } else {
                    alert('Failed to register attendance.');
                }
            },
            error: function () {
                alert('Error processing your request.');
            }
        });
    });

    // Initialize calendar with events
    if ($('#calendar').length > 0) {
        const events = JSON.parse($('#calendar').attr('data-events'));
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events.map(event => ({
                title: event.title,
                start: event.date + 'T' + event.time,
                url: 'event_details.php?id=' + event.id
            }))
        });
        calendar.render();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Ensure the calendar is initialized correctly
    if (document.getElementById('calendar')) {
        const events = JSON.parse(document.getElementById('calendar').dataset.events);
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events.map(event => ({
                title: event.title,
                start: event.date + 'T' + event.time,
                url: 'event_details.php?id=' + event.id
            }))
        });
        calendar.render();
    }
});
