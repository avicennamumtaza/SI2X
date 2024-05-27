<?php

namespace App\Enums;

enum GolDar: string
{
    case A = "A";
    case AB = "AB";
    case B = "B";
    case O = "O";

    public function getDescription(): string
    {
        return match($this) {
            self::A => "A",
            self::AB => "AB",
            self::B => "B",
            self::O => "O",
        };
    }
}