<?php

namespace App\Enums;

enum Pendidikan: string
{
    case TIDAK_BELUM_SEKOLAH = 'Tidak/Belum Sekolah';
    case BELUM_TAMAT_SD = 'Belum Tamat SD/Sederajat';
    case TAMAT_SD = 'Tamat SD/Sederajat';
    case SLTP = 'SLTP/Sederajat';
    case SLTA = 'SLTA/Sederajat';
    case DIPLOMA_I_II = 'Diploma I/II';
    case AKADEMI_DIPLOMA_III = 'Akademi/Diploma III/S. Muda';
    case DIPLOMA_IV_STRATA_I = 'Diploma IV/Strata I';
    case STRATA_II = 'Strata II';
    case STRATA_III = 'Strata III';
}
