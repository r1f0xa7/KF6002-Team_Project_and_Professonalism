<?php include(__DIR__.'/../../includes/header.php'); ?>
<?php
$post = $forumModel->getPostById($_GET['id']);
$comments = $forumModel->getCommentsByPostId($_GET['id']);
?>
<div class="container">
    <h2><?php echo $post['post_title']; ?></h2>
    <p>by <?php echo $post['author']; ?> on <?php echo $post['created_at']; ?></p>
    <p><?php echo nl2br($post['post_content']); ?></p>

    <h4>Comments</h4>
    <ul class="list-group">
        <?php foreach ($comments as $comment) : ?>
            <li class="list-group-item">
                <p><?php echo nl2br($comment['comment_content']); ?></p>
                <small>by <?php echo $comment['commenter']; ?> on <?php echo $comment['created_at']; ?></small>
            </li>
        <?php endforeach; ?>
    </ul>

    <h4>Add a Comment</h4>
    <form action="../controllers/forum_controller.php" method="POST">
        <div class="form-group">
            <textarea name="comment_content" class="form-control" rows="5" required></textarea>
        </div>
        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
        <button type="submit" name="add_comment" class="btn btn-primary">Submit Comment</button>
    </form>
</div>
<?php include(__DIR__.'/../../includes/footer.php'); ?>
