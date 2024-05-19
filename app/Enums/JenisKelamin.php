<?php

namespace App\Enums;

enum JenisKelamin: string
{
    case L = "L";
    case P = "P";

    public function getDescription(): string
    {
        return match($this) {
            self::L => "Laki-Laki",
            self::P => "Perempuan",
        };
    }
}
