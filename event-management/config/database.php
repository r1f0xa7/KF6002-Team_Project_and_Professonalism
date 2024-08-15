<?php
// Database connection using PDO
try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    customExceptionHandler($e);
    die('Database connection failed: ' . $e->getMessage());
}




// // Test database connection
// if ($pdo) {
//     echo "Database connection successful!";
// } else {
//     echo "Database connection failed!";
// }
