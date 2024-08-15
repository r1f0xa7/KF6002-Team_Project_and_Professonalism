<?php include(__DIR__.'/../../includes/header.php'); ?>
<div class="container">
    <h2>Create New Post</h2>
    <form action="../controllers/forum_controller.php" method="POST">
        <div class="form-group">
            <label for="post_title">Title:</label>
            <input type="text" name="post_title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="post_content">Content:</label>
            <textarea name="post_content" class="form-control" rows="10" required></textarea>
        </div>
        <button type="submit" name="create_post" class="btn btn-success">Create Post</button>
    </form>
</div>
<?php include(__DIR__.'/../../includes/footer.php'); ?>
