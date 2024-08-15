<?php include(__DIR__.'/../../includes/header.php');
require_once(__DIR__.'/../../config/database.php');
require_once(__DIR__.'/../../models/User.php');

$userModel = new User($pdo);

$user = $userModel->getUserById($_SESSION['user_id']);
?>
<div class="container">
    <h2>Your Profile</h2>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <td><?php echo $user['name']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $user['email']; ?></td>
        </tr>
        <tr>
            <th>Role</th>
            <td><?php echo ucfirst($user['role']); ?></td>
        </tr>
    </table>
    <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
</div>
<?php include(__DIR__.'/../../includes/footer.php'); ?>
