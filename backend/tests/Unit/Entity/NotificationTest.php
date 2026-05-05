<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Notification;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    private Notification $notification;

    protected function setUp(): void
    {
        $this->notification = new Notification();
    }

    public function testDefaultTypeIsSystem(): void
    {
        $this->assertSame('SYSTEM', $this->notification->getType());
    }

    public function testDefaultIsReadFalse(): void
    {
        $this->assertFalse($this->notification->isRead());
    }

    public function testDefaultBodyIsNull(): void
    {
        $this->assertNull($this->notification->getBody());
    }

    public function testDefaultReferenceIdIsNull(): void
    {
        $this->assertNull($this->notification->getReferenceId());
    }

    public function testCreatedAtIsSetOnConstruct(): void
    {
        $this->assertNotNull($this->notification->getCreatedAt());
    }

    public function testGetIconForMessageTypeReturnsChatBubble(): void
    {
        $this->notification->setType('MESSAGE');
        $this->assertSame('💬', $this->notification->getIcon());
    }

    public function testGetIconForContactRequestTypeReturnsHandshake(): void
    {
        $this->notification->setType('CONTACT_REQUEST');
        $this->assertSame('🤝', $this->notification->getIcon());
    }

    public function testGetIconForSystemTypeReturnsGear(): void
    {
        $this->notification->setType('SYSTEM');
        $this->assertSame('⚙️', $this->notification->getIcon());
    }

    public function testGetIconForUnknownTypeReturnsDefaultBell(): void
    {
        $this->notification->setType('UNKNOWN_TYPE');
        $this->assertSame('🔔', $this->notification->getIcon());
    }

    public function testSetAndGetTitle(): void
    {
        $this->notification->setTitle('New message received');
        $this->assertSame('New message received', $this->notification->getTitle());
    }

    public function testSetAndGetBody(): void
    {
        $this->notification->setBody('You have a new message from your therapist.');
        $this->assertSame('You have a new message from your therapist.', $this->notification->getBody());
    }

    public function testSetBodyToNull(): void
    {
        $this->notification->setBody('Some body');
        $this->notification->setBody(null);
        $this->assertNull($this->notification->getBody());
    }

    public function testSetIsReadToTrue(): void
    {
        $this->notification->setIsRead(true);
        $this->assertTrue($this->notification->isRead());
    }

    public function testSetAndGetReferenceId(): void
    {
        $this->notification->setReferenceId(42);
        $this->assertSame(42, $this->notification->getReferenceId());
    }

    public function testSetUserReturnsSelf(): void
    {
        $user = new User();
        $user->setEmail('user@test.com');
        $result = $this->notification->setUser($user);
        $this->assertSame($this->notification, $result);
        $this->assertSame($user, $this->notification->getUser());
    }

    public function testSetTypeReturnsSelf(): void
    {
        $result = $this->notification->setType('MESSAGE');
        $this->assertSame($this->notification, $result);
    }
}
