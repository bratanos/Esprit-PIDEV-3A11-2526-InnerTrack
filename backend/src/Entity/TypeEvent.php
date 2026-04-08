<?php

namespace App\Entity;

enum TypeEvent: int
{
    case CONFERENCE = 1;
    case ATELIER    = 2;
    case FORUM      = 3;
    case WEBINAIRE  = 4;

    public function label(): string
    {
        return match($this) {
            self::CONFERENCE => 'Conférence',
            self::ATELIER    => 'Atelier',
            self::FORUM      => 'Forum',
            self::WEBINAIRE  => 'Webinaire',
        };
    }
}

