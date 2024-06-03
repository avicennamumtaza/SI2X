<?php

namespace App\Models;

use App\Enums\Agama;
use App\Enums\GolDar;
use App\Enums\JenisKelamin;
use App\Enums\Pekerjaan;
use App\Enums\Pendidikan;
use App\Enums\StatusPernikahan;
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
        'agama',
        'pendidikan',
        'pekerjaan',
        'golongan_darah',
        'status_pernikahan',
        'status_pendatang',
    ];

    protected $casts = [
        'golongan_darah' => GolDar::class,
        'jenis_kelamin' => JenisKelamin::class,
        'agama' => Agama::class,
        'pendidikan' => Pendidikan::class,
        'pekerjaan' => Pekerjaan::class,
        'status_pernikahan' => StatusPernikahan::class,
    ];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'nkk', 'nkk');
    }

    public function rw(): HasOne
    {
        return $this->hasOne(RW::class, 'nik_rw', 'nik');
    }

    public function rt(): HasOne
    {
        return $this->hasOne(RT::class, 'nik_rt', 'nik');
    }

    public function users(): HasOne
    {
        return $this->hasOne(Users::class, 'nik', 'nik');
    }

    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class, 'nik_pemilik', 'nik');
    }

    public function pengajuan(): HasMany
    {
        return $this->hasMany(PengajuanDokumen::class, 'nik', 'nik');
    }
}
