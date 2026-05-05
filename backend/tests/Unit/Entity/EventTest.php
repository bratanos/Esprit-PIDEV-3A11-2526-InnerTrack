<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Event;
use App\Entity\TypeEvent;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    private Event $event;

    protected function setUp(): void
    {
        $this->event = new Event();
    }

    public function testDefaultStatutIsTrue(): void
    {
        $this->assertTrue($this->event->isStatut());
    }

    public function testDateCreationIsSetOnConstruct(): void
    {
        $this->assertNotNull($this->event->getDateCreation());
    }

    public function testInscriptionsCollectionIsEmptyOnConstruct(): void
    {
        $this->assertCount(0, $this->event->getInscriptions());
    }

    public function testIdIsNullBeforePersistence(): void
    {
        $this->assertNull($this->event->getId());
    }

    public function testSetAndGetTitre(): void
    {
        $this->event->setTitre('Conférence sur le bien-être');
        $this->assertSame('Conférence sur le bien-être', $this->event->getTitre());
    }

    public function testSetAndGetDescription(): void
    {
        $desc = 'Une description détaillée pour cet événement.';
        $this->event->setDescription($desc);
        $this->assertSame($desc, $this->event->getDescription());
    }

    public function testSetDescriptionToNull(): void
    {
        $this->event->setDescription(null);
        $this->assertNull($this->event->getDescription());
    }

    public function testSetAndGetCapacite(): void
    {
        $this->event->setCapacite(150);
        $this->assertSame(150, $this->event->getCapacite());
    }

    public function testSetAndGetType(): void
    {
        $this->event->setType(TypeEvent::CONFERENCE);
        $this->assertSame(TypeEvent::CONFERENCE, $this->event->getType());
    }

    public function testSetAndGetDate(): void
    {
        $date = new \DateTime('2026-06-15');
        $this->event->setDate($date);
        $this->assertSame($date, $this->event->getDate());
    }

    public function testSetStatutToFalse(): void
    {
        $this->event->setStatut(false);
        $this->assertFalse($this->event->isStatut());
    }

    public function testSetAndGetImage(): void
    {
        $this->event->setImage('event_banner.jpg');
        $this->assertSame('event_banner.jpg', $this->event->getImage());
    }

    public function testSetImageToNull(): void
    {
        $this->event->setImage(null);
        $this->assertNull($this->event->getImage());
    }

    public function testSetTitreReturnsSelf(): void
    {
        $result = $this->event->setTitre('Test');
        $this->assertSame($this->event, $result);
    }

    public function testSetCapaciteReturnsSelf(): void
    {
        $result = $this->event->setCapacite(50);
        $this->assertSame($this->event, $result);
    }

    public function testAllTypeEnumValuesCanBeSet(): void
    {
        foreach (TypeEvent::cases() as $type) {
            $this->event->setType($type);
            $this->assertSame($type, $this->event->getType());
        }
    }
}
