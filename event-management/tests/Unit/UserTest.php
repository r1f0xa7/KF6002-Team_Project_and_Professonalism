<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    protected $pdo;
    protected $userModel;

    protected function setUp(): void {
        $this->pdo = new PDO('mysql:host=localhost;dbname=event_management_test', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->userModel = new User($this->pdo);
    }

    public function testRegisterUser() {
        $result = $this->userModel->register('Test User', 'testuser@example.com', 'password123');
        $this->assertTrue($result);
    }

    public function testLoginUser() {
        $user = $this->userModel->login('testuser@example.com', 'password123');
        $this->assertIsArray($user);
    }
}
