<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangan';
    protected $primaryKey = 'id_laporankeuangan';
    protected $fillable = [
        'status_pemasukan',
        'nominal',
        'tanggal',
        'pihak_terlibat',
        'detail',
        'saldo',
    ];

    // public function rw(): BelongsTo
    // {
    //     return $this->belongsTo(RW::class, 'nik_rw', 'nik_rw');
    // }
}
