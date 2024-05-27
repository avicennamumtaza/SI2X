<?php

namespace App\Enums;

enum StatusPernikahan: string
{
    case KAWIN = "Kawin";
    case BELUM_KAWIN = "Belum Kawin";
    case CERAI_HIDUP = "Cerai Hidup";
    case CERAI_MATI = "Cerai Mati";

    public function getDescription(): string
    {
        return match($this) {
            self::KAWIN => "Kawin",
            self::BELUM_KAWIN => "Belum Kawin",
            self::CERAI_HIDUP => "Cerai Hidup",
            self::CERAI_MATI => "Cerai Mati",
        };
    }
}
