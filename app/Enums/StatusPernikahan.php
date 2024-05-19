<?php

namespace App\Enums;

enum StatusPernikahan: string
{
    case KAWIN = "Kawin";
    case BELUM_KAWIN = "Belum Kawin";
    case CERAI_HIDUP = "Cerai Hidup";
    case CERAI_MATI = "Cerai Mati";

}
