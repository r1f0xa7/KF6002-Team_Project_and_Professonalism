<?php


// Error Reporting Configuration
error_reporting(E_ALL);

// Determine the environment (development/production)
$environment = 'secure'; // Change this to 'production' when deploying

if ($environment === 'development') {
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
} else {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}


// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'event_management');

// Site configuration
define('SITE_NAME', 'Rose Foundation Event Management');
//define('BASE_URL', 'https://practice.mdrifat.dev/sftpuser_uploads/event-management/');
define('BASE_URL', 'http://localhost/RESIT%20-%20LAST/event-management/');

// Admin email for notifications, etc.
define('ADMIN_EMAIL', 'admin@rosefoundation.com');

// Other global settings
define('MAX_ATTENDANCE', 100);

// Session Configuration
$sessionPath = __DIR__ . '/../sessions';

if (session_status() == PHP_SESSION_NONE) {
    if (!file_exists($sessionPath)) {
        mkdir($sessionPath, 0700, true);
    }
    
    ini_set('session.save_path', $sessionPath);
    ini_set('session.cookie_secure', 1);  // Ensure cookies are sent over HTTPS
    ini_set('session.cookie_httponly', 1); // Prevent JavaScript from accessing session cookies
    ini_set('session.use_strict_mode', 1); // Reject uninitialized session IDs
    session_start();
}

// // Email Configuration for PHPMailer
// define('SMTP_ENABLED', false);
// define('SMTP_HOST', 'smtp.example.com');
// define('SMTP_USER', 'your-email@example.com');
// define('SMTP_PASS', 'your-email-password');
// define('SMTP_PORT', 587);
// define('SMTP_SECURE', 'tls');

// // ReCAPTCHA Configuration (Optional if you plan to use CAPTCHA)
// define('RECAPTCHA_SITE_KEY', 'your-recaptcha-site-key');
// define('RECAPTCHA_SECRET_KEY', 'your-recaptcha-secret-key');

// // Encryption Key for Secure Data (Optional)
// define('ENCRYPTION_KEY', 'your-secret-encryption-key');


// Log Directory Configuration
define('LOG_DIR', __DIR__ . '/../logs');
if (!file_exists(LOG_DIR)) {
    mkdir(LOG_DIR, 0700, true);
}


// Custom Error Handler
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    $errorMessage = "[" . date('Y-m-d H:i:s') . "] Error: [$errno] $errstr in $errfile on line $errline" . PHP_EOL;
    error_log($errorMessage, 3, LOG_DIR . '/error.log');

    // Display a user-friendly message to the user
    if (ini_get('display_errors')) {
        echo "<b>Error:</b> Something went wrong! Please try again later.";
    }
}

// Custom Exception Handler
function customExceptionHandler($exception) {
    $errorMessage = "[" . date('Y-m-d H:i:s') . "] Uncaught exception: " . $exception->getMessage() . " in " . $exception->getFile() . " on line " . $exception->getLine() . PHP_EOL;
    error_log($errorMessage, 3, LOG_DIR . '/error.log');

    // Display a user-friendly message to the user
    if (ini_get('display_errors')) {
        echo "<b>Exception:</b> Something went wrong! Please try again later.";
    }
}

// Custom Shutdown Handler
function customShutdownHandler() {
    $error = error_get_last();
    if ($error !== NULL) {
        $errorMessage = "[" . date('Y-m-d H:i:s') . "] Fatal error: " . $error['message'] . " in " . $error['file'] . " on line " . $error['line'] . PHP_EOL;
        error_log($errorMessage, 3, LOG_DIR . '/error.log');
        if (ini_get('display_errors')) {
            echo "<b>Fatal Error:</b> Something went wrong! Please try again later.";
        }
    }
}

// Access Logging
function logAccess() {
    $logMessage = "[" . date('Y-m-d H:i:s') . "] " . $_SERVER['REMOTE_ADDR'] . " accessed " . $_SERVER['REQUEST_URI'] . PHP_EOL;
    error_log($logMessage, 3, LOG_DIR . '/access.log');
}

// Register the custom error, exception, and shutdown handlers
set_error_handler('customErrorHandler');
set_exception_handler('customExceptionHandler');
register_shutdown_function('customShutdownHandler');
logAccess();