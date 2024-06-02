<?php

namespace App\Models;

use App\Enums\DayaListrik;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';
    protected $primaryKey = 'nkk';
    protected $fillable = [
        'nkk',
        'penghasilan',
        'tanggungan',
        'pajak_bumibangunan',
        'pajak_kendaraan',
        'daya_listrik',
    ];
    // protected $casts = [
    //     'daya_listrik' => DayaListrik::class
    // ];
    public function keluarga(): HasOne {
        return $this->hasOne(Keluarga::class, 'nkk', 'nkk');
    }
}
