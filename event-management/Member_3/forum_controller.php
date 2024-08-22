<?php
require_once '../config/database.php';
require_once '../models/Forum.php';

session_start();

if (!isLoggedIn()) {
    redirect('login.php');
}

$forumModel = new Forum($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_post'])) {
        $title = sanitize($_POST['post_title']);
        $content = sanitize($_POST['post_content']);
        $userId = $_SESSION['user_id'];

        if ($forumModel->createPost($userId, $title, $content)) {
            flash('post_created', 'Post created successfully');
            redirect('forum_list.php');
        } else {
            flash('post_create_fail', 'Failed to create post', 'alert alert-danger');
        }
    }

    if (isset($_POST['add_comment'])) {
        $postId = sanitize($_POST['post_id']);
        $comment = sanitize($_POST['comment_content']);
        $userId = $_SESSION['user_id'];

        if ($forumModel->addComment($postId, $userId, $comment)) {
            flash('comment_added', 'Comment added successfully');
            redirect('forum_post.php?id=' . $postId);
        } else {
            flash('comment_add_fail', 'Failed to add comment', 'alert alert-danger');
        }
    }
}
