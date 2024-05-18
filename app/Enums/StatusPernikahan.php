<?php

namespace App\Enums;

enum StatusPernikahan: string
{
    case KAWIN = "Kawin";
    case BELUM_KAWIN = "Belum Kawin";
    case CERAU_HIDUP = "Cerai Hidup";
    case CERAI_MATI = "Cerai Mati";

}