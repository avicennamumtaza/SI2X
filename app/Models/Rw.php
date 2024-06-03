<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rw';
    protected $primaryKey = 'no_rw';
    protected $fillable = [
        'no_rw',
        'nik_rw',
        'wa_rw',
    ];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'nik_rw', 'nik');
    }

    // public function umkm(): HasMany
    // {
    //     return $this->hasMany(Umkm::class, 'no_rw', 'no_rw');
    // }

    // public function pengumuman(): HasMany
    // {
    //     return $this->hasMany(Pengumuman::class, 'no_rw', 'no_rw');
    // }

    // public function laporan(): HasMany
    // {
    //     return $this->hasMany(LaporanKeuangan::class, 'no_rw', 'no_rw');
    // }
}
