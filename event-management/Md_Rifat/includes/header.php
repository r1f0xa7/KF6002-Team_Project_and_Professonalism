<?php
// Start session and include necessary files
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__.'/../../config/config.php';
require_once  __DIR__.'/../../config/functions.php';
require_once __DIR__.'/../../models/User.php';

// Check if user is logged in
$isLoggedIn = isLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />

    <!-- FullCalendar JS -->   
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script> 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo BASE_URL; ?>public/index.php">
        <img src="<?php echo BASE_URL; ?>assets/images/Rose_Foundation_Logo.jpeg" alt="Rose Foundation Logo">
        Rose Foundation Event Management
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>public/index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>Md_Rifat/about.php">About</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>Md_Rifat/calendar.php">Calendar</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>Md_Rifat/event_list.php">Events</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>Member_3/forum_list.php">Forum</a></li>
            <?php if (isLoggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Member_2/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Md_Rifat/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger" href="<?php echo BASE_URL; ?>public/logout.php">Logout</a>
                    </li>
            <?php else: ?>
                    <li class="nav-item" style="padding-right: 2px;">
                        <a class="nav-link btn btn-primary" href="<?php echo BASE_URL; ?>Member_2/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="<?php echo BASE_URL; ?>Member_2/register.php">Register</a>
                    </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container mt-5">
