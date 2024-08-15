<?php
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase {
    protected $pdo;
    protected $eventModel;

    protected function setUp(): void {
        $this->pdo = new PDO('mysql:host=localhost;dbname=event_management_test', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->eventModel = new Event($this->pdo);
    }

    public function testCreateEvent() {
        $result = $this->eventModel->createEvent('Test Event', 'This is a test event.', '2024-01-01', '12:00:00', 'Test Location');
        $this->assertTrue($result);
    }

    public function testGetEvents() {
        $events = $this->eventModel->getEvents();
        $this->assertIsArray($events);
    }
}
