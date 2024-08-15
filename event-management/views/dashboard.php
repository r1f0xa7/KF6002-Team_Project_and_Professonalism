<?php include(__DIR__.'/../includes/header.php'); ?>
<?php include(__DIR__.'/../includes/sidebar.php'); ?>
<div class="container">
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['user_name']; ?>!</p>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Events</h5>
                    <p class="card-text">Check out the events you're attending soon.</p>
                    <a href="events/event_list.php" class="btn btn-primary">View Events</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Community Forum</h5>
                    <p class="card-text">Join the discussion with other attendees.</p>
                    <a href="forum/forum_list.php" class="btn btn-primary">Visit Forum</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile Settings</h5>
                    <p class="card-text">Update your profile information and settings.</p>
                    <a href="users/profile.php" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__.'/../includes/footer.php'); ?>
