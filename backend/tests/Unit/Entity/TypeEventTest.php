<?php

namespace App\Tests\Unit\Entity;

use App\Entity\TypeEvent;
use PHPUnit\Framework\TestCase;

class TypeEventTest extends TestCase
{
    public function testConferenceHasValueOne(): void
    {
        $this->assertSame(1, TypeEvent::CONFERENCE->value);
    }

    public function testAtelierHasValueTwo(): void
    {
        $this->assertSame(2, TypeEvent::ATELIER->value);
    }

    public function testForumHasValueThree(): void
    {
        $this->assertSame(3, TypeEvent::FORUM->value);
    }

    public function testWebinaireHasValueFour(): void
    {
        $this->assertSame(4, TypeEvent::WEBINAIRE->value);
    }

    public function testConferenceLabelIsInFrench(): void
    {
        $this->assertSame('Conférence', TypeEvent::CONFERENCE->label());
    }

    public function testAtelierLabelIsCorrect(): void
    {
        $this->assertSame('Atelier', TypeEvent::ATELIER->label());
    }

    public function testForumLabelIsCorrect(): void
    {
        $this->assertSame('Forum', TypeEvent::FORUM->label());
    }

    public function testWebinaireLabelIsCorrect(): void
    {
        $this->assertSame('Webinaire', TypeEvent::WEBINAIRE->label());
    }

    public function testFromIntegerValueReturnsCorrectCase(): void
    {
        $this->assertSame(TypeEvent::CONFERENCE, TypeEvent::from(1));
        $this->assertSame(TypeEvent::ATELIER, TypeEvent::from(2));
        $this->assertSame(TypeEvent::FORUM, TypeEvent::from(3));
        $this->assertSame(TypeEvent::WEBINAIRE, TypeEvent::from(4));
    }

    public function testTryFromWithInvalidValueReturnsNull(): void
    {
        $this->assertNull(TypeEvent::tryFrom(99));
    }

    public function testAllCasesArePresent(): void
    {
        $cases = TypeEvent::cases();
        $this->assertCount(4, $cases);
    }
}
