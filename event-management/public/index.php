<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../config/functions.php';

// Load requested page
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$file = '../Md_Rifat/' . $url . '.php';

if (file_exists($file)) {
    require_once $file;
} else {
    require_once '../views/404.php';
}
