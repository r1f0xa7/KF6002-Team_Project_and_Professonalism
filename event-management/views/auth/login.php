<?php 
include(__DIR__.'/../../includes/header.php'); 
require_once '../../config/database.php';
require_once '../../models/User.php';
require_once '../../config/functions.php';

if(isLoggedIn()) {
    header('Location: ../dashboard.php');
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $userModel = new User($pdo);
    $user = $userModel->login($email, $password);

    if ($user) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // Redirect to the dashboard or home page
        header('Location: ../dashboard.php'); // Replace with your actual dashboard or homepage
        exit();
    } else {
        // Set flash message and redirect back to login
        flash('login_fail', 'Invalid email or password', 'alert alert-danger');
        header('Location: login.php');
        exit();
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Login</h2>
            <?php flash('login_fail'); ?>
            <form action="login.php" method="POST">
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <div class="text-center mt-3">
                    <a href="register.php">Don't have an account? Register</a> | 
                    <a href="#" onclick="alert('The password reset system is currently disabled or under maintenance. Please contact support if you need assistance.');">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include(__DIR__.'/../../includes/footer.php'); ?>
