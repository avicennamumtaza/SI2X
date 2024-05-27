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

    public function getDescription(): string
    {
        return match($this) {
            self::TIDAK_BELUM_SEKOLAH => 'Tidak/Belum Sekolah',
            self::BELUM_TAMAT_SD => 'Belum Tamat SD/Sederajat',
            self::TAMAT_SD => 'Tamat SD/Sederajat',
            self::SLTP => 'SLTP/Sederajat',
            self::SLTA => 'SLTA/Sederajat',
            self::DIPLOMA_I_II => 'Diploma I/II',
            self::AKADEMI_DIPLOMA_III => 'Akademi/Diploma III/S. Muda',
            self::DIPLOMA_IV_STRATA_I => 'Diploma IV/Strata I',
            self::STRATA_II => 'Strata II',
            self::STRATA_III => 'Strata III',
        };
    }
}
