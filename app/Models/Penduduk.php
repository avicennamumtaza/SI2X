<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduk';
    protected $primaryKey = 'nik';
    protected $fillable = [
        'nik',
        'nkk',
        'no_rt',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'pekerjaan',
        'golongan_darah',
        'status_pernikahan',
        'status_domisili',
    ];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'nkk', 'nkk');
    }

    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class, 'nik_pemilik', 'nik');
    }

    public function users(): HasOne
    {
        return $this->hasOne(Users::class, 'nik', 'nik');
    }

    public function rw(): HasOne
    {
        return $this->hasOne(Rw::class, 'nik_rw', 'nik');
    }

    public function pengajuan(): HasMany
    {
        return $this->hasMany(PengajuanDokumen::class, 'nik', 'nik');
    }

    public function rt(): HasOne
    {
        return $this->hasOne(Rt::class, 'nik_rt', 'nik');
    }
}
