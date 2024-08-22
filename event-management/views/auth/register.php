<?php 
include(__DIR__.'/../../includes/header.php'); 
require_once '../../config/database.php';
require_once '../../models/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];

    if ($password !== $passwordConfirm) {
        flash('register_fail', 'Passwords do not match', 'alert alert-danger');
        header('Location: register.php');
        exit();
    }

    $userModel = new User($pdo);

    // Check if email already exists
    if ($userModel->getUserByEmail($email)) {
        flash('register_fail', 'Email is already registered', 'alert alert-danger');
        header('Location: register.php');
        exit();
    }

    $token = null; // Since email verification is not implemented
    if ($userModel->register($name, $email, $password, $token)) {
        flash('register_success', 'Registration successful! You can now log in.', 'alert alert-success');
        header('Location: login.php');
        exit();
    } else {
        flash('register_fail', 'Registration failed, please try again', 'alert alert-danger');
        header('Location: register.php');
        exit();
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Register</h2>
            <?php flash('register_fail'); ?>
            <form action="register.php" method="POST">
                <div class="form-group mb-3">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirm">Confirm Password:</label>
                    <input type="password" name="password_confirm" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Register</button>
            </form>
            <div class="text-center mt-3">
                <a href="login.php">Already have an account? Login</a>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__.'/../../includes/footer.php'); ?>
