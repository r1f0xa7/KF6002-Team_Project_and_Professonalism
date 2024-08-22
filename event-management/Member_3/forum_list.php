<?php 

include(__DIR__.'/../Md_Rifat/includes/header.php'); 
require_once(__DIR__.'/../config/database.php'); // Include database connection
require_once(__DIR__.'/../models/Forum.php'); // Include the Forum model

$forumModel = new Forum($pdo); // Instantiate the Forum model
$posts = $forumModel->getPosts(); // Fetch posts using the model
?>
<div class="container">
    <h2>Forum Posts</h2>
    <?php if (empty($posts)): ?>
        <p>No posts available.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($posts as $post): ?>
                <li><?php echo htmlspecialchars($post['title']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<?php include(__DIR__.'/../Md_Rifat/includes/footer.php'); ?>