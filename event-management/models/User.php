<?php
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function register($name, $email, $password, $token) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, token, is_verified) VALUES (:name, :email, :password, :token, 0)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $passwordHash,
            ':token' => $token,
        ]);
    }

    public function login($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function verifyEmail($token) {
        $sql = "UPDATE users SET is_verified = 1, token = NULL WHERE token = :token";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':token' => $token]);
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // public function setResetToken($userId, $token) {
    //     $sql = "UPDATE users SET reset_token = :token, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = :id";
    //     $stmt = $this->db->prepare($sql);
    //     return $stmt->execute([':token' => $token, ':id' => $userId]);
    // }

    // public function getUserByToken($token) {
    //     $sql = "SELECT * FROM users WHERE reset_token = :token AND reset_token_expiry > NOW()";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->execute([':token' => $token]);
    //     return $stmt->fetch();
    // }

    // public function updatePassword($userId, $passwordHash) {
    //     $sql = "UPDATE users SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE id = :id";
    //     $stmt = $this->db->prepare($sql);
    //     return $stmt->execute([':password' => $passwordHash, ':id' => $userId]);
    // }
}
