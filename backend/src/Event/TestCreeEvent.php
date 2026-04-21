<?php

namespace App\Event;

use App\Entity\Testpsy\TestPsychologique;

class TestCreeEvent
{
    public function __construct(
        public readonly TestPsychologique $test
    ) {}
}