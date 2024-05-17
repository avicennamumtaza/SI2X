<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';
    protected $primaryKey = 'id_umkm';
    protected $fillable = [
        'nik_pemilik',
        'nama_umkm',
        'alamat_umkm',
        'wa_umkm',
        'foto_umkm',
<<<<<<<<< Temporary merge branch 1
        'deskripsi_umkm',
=========
        'desc_umkm',
        'alamat',
>>>>>>>>> Temporary merge branch 2
        'status_umkm',
    ];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'nik_pemilik', 'nik');
    }

    // public function rw(): BelongsTo
    // {
    //     return $this->belongsTo(Rw::class, 'nik_pemilik', 'nik_rw');
    // }
}
