<?php include(__DIR__.'/../../includes/header.php'); ?>
<?php
$user = $userModel->getUserById($_SESSION['user_id']);
?>
<div class="container">
    <h2>Edit Profile</h2>
    <form action="../../controllers/user_controller.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control">
            <small>Leave blank to keep current password.</small>
        </div>
        <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
    </form>
</div>
<?php include(__DIR__.'/../../includes/footer.php'); ?>
