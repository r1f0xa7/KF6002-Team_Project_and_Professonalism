<?php
require_once '../config/database.php';
require_once '../models/User.php';

session_start();

$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);
        $passwordConfirm = sanitize($_POST['password_confirm']);

        // Basic validation
        if (empty($name) || empty($email) || empty($password) || empty($passwordConfirm)) {
            flash('register_fail', 'All fields are required', 'alert alert-danger');
            redirect('register.php');
        }

        // Email format validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash('register_fail', 'Invalid email address', 'alert alert-danger');
            redirect('register.php');
        }

        // Password confirmation validation
        if ($password !== $passwordConfirm) {
            flash('register_fail', 'Passwords do not match', 'alert alert-danger');
            redirect('register.php');
        }

        // Check if the email already exists
        if ($userModel->getUserByEmail($email)) {
            flash('register_fail', 'Email is already registered', 'alert alert-danger');
            redirect('register.php');
        }

        // Registration without email verification
        if ($userModel->register($name, $email, $password, null)) {
            flash('register_success', 'Registration successful! You can now log in.', 'alert alert-success');
            redirect('login.php');
        } else {
            flash('register_fail', 'Registration failed, please try again', 'alert alert-danger');
            redirect('register.php');
        }
    }

    if (isset($_POST['login'])) {
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);

        // Basic validation
        if (empty($email) || empty($password)) {
            flash('login_fail', 'Email and password are required', 'alert alert-danger');
            redirect('login.php');
        }

        // Email format validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash('login_fail', 'Invalid email address', 'alert alert-danger');
            redirect('login.php');
        }

        // Attempt to log in
        $loggedInUser = $userModel->login($email, $password);

        if ($loggedInUser) {
            // No email verification needed
            $_SESSION['user_id'] = $loggedInUser['id'];
            $_SESSION['user_name'] = $loggedInUser['name'];
            $_SESSION['user_role'] = $loggedInUser['role'];
            redirect('dashboard.php');
        } else {
            flash('login_fail', 'Invalid login credentials', 'alert alert-danger');
            redirect('login.php');
        }
    }
}

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

function flash($name = '', $message = '', $class = 'alert alert-success') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'alert alert-success';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

function redirect($page) {
    header('location: ' . BASE_URL . 'views/auth/' . $page);
    exit();
}
