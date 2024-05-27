<?php

namespace App\Enums;

enum Agama: string
{
    case ISLAM = "Islam";
    case KRISTEN = "Kristen";
    case KATOLIK = "Katolik";
    case HINDU = "Hindu";
    case BUDDHA = "Buddha";
    case KONGHUCU = "Konghucu";

    public function getDescription(): string
    {
        return match($this) {
            self::ISLAM => "Islam",
            self::KRISTEN => "Kristen",
            self::KATOLIK => "Katolik",
            self::HINDU => "Hindu",
            self::BUDDHA => "Buddha",
            self::KONGHUCU => "Konghucu",
        };
    }
}
