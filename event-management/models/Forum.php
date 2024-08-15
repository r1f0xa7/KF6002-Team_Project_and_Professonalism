<?php
class Forum {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Create a new forum post
    public function createPost($userId, $title, $content) {
        $sql = "INSERT INTO forum (user_id, post_title, post_content) VALUES (:user_id, :post_title, :post_content)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':post_title' => $title,
            ':post_content' => $content,
        ]);
    }

    // Get all forum posts
    public function getPosts() {
        $sql = "SELECT forum.*, users.name AS author FROM forum JOIN users ON forum.user_id = users.id ORDER BY forum.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single forum post by ID
    public function getPostById($id) {
        $sql = "SELECT forum.*, users.name AS author FROM forum JOIN users ON forum.user_id = users.id WHERE forum.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a comment to a forum post
    public function addComment($postId, $userId, $comment) {
        $sql = "INSERT INTO comments (forum_id, user_id, comment_content) VALUES (:forum_id, :user_id, :comment_content)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':forum_id' => $postId,
            ':user_id' => $userId,
            ':comment_content' => $comment,
        ]);
    }

    // Get all comments for a specific forum post
    public function getCommentsByPostId($postId) {
        $sql = "SELECT comments.*, users.name AS commenter FROM comments JOIN users ON comments.user_id = users.id WHERE forum_id = :forum_id ORDER BY comments.created_at ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':forum_id' => $postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
