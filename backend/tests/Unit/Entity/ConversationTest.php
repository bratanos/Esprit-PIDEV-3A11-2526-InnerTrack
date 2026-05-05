<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Conversation;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ConversationTest extends TestCase
{
    private Conversation $conversation;
    private User $client;
    private User $therapist;

    protected function setUp(): void
    {
        $this->conversation = new Conversation();
        $this->client = new User();
        $this->therapist = new User();
        $this->setUserId($this->client, 1);
        $this->setUserId($this->therapist, 2);
        $this->conversation->setClient($this->client);
        $this->conversation->setTherapist($this->therapist);
    }

    private function setUserId(User $user, int $id): void
    {
        $reflection = new \ReflectionProperty(User::class, 'id');
        $reflection->setAccessible(true);
        $reflection->setValue($user, $id);
    }

    public function testDefaultStatusIsPending(): void
    {
        $this->assertSame('PENDING', $this->conversation->getStatus());
    }

    public function testCreatedAtIsSetOnConstruct(): void
    {
        $this->assertNotNull($this->conversation->getCreatedAt());
    }

    public function testMessagesCollectionIsEmptyOnConstruct(): void
    {
        $this->assertCount(0, $this->conversation->getMessages());
    }

    public function testIsActiveReturnsTrueWhenStatusIsActive(): void
    {
        $this->conversation->setStatus('ACTIVE');
        $this->assertTrue($this->conversation->isActive());
    }

    public function testIsActiveReturnsFalseWhenStatusIsPending(): void
    {
        $this->assertFalse($this->conversation->isActive());
    }

    public function testIsActiveReturnsFalseWhenStatusIsClosed(): void
    {
        $this->conversation->setStatus('CLOSED');
        $this->assertFalse($this->conversation->isActive());
    }

    public function testGetOtherUserWhenCallerIsClientReturnsTherapist(): void
    {
        $other = $this->conversation->getOtherUser($this->client);
        $this->assertSame($this->therapist, $other);
    }

    public function testGetOtherUserWhenCallerIsTherapistReturnsClient(): void
    {
        $other = $this->conversation->getOtherUser($this->therapist);
        $this->assertSame($this->client, $other);
    }

    public function testSetAndGetStatus(): void
    {
        $this->conversation->setStatus('ACTIVE');
        $this->assertSame('ACTIVE', $this->conversation->getStatus());
    }

    public function testSetClientReturnsSelf(): void
    {
        $user = new User();
        $result = $this->conversation->setClient($user);
        $this->assertSame($this->conversation, $result);
    }

    public function testSetTherapistReturnsSelf(): void
    {
        $user = new User();
        $result = $this->conversation->setTherapist($user);
        $this->assertSame($this->conversation, $result);
    }
}
