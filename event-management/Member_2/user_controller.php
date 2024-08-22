<?php
require_once '../config/database.php';
require_once '../models/User.php';

session_start();

if (!isLoggedIn()) {
    redirect('login.php');
}

$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        $userId = $_SESSION['user_id'];
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        $password = !empty($_POST['password']) ? password_hash(sanitize($_POST['password']), PASSWORD_DEFAULT) : null;

        if ($password) {
            $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':name' => $name, ':email' => $email, ':password' => $password, ':id' => $userId]);
        } else {
            $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':name' => $name, ':email' => $email, ':id' => $userId]);
        }

        flash('profile_updated', 'Profile updated successfully');
        redirect('profile.php');
    }
}
