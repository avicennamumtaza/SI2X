<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = [
        'nominal',
        'detail_laporan',
        'tanggal_laporan',
        'pihak_terlibat',
        'saldo',
        'is_income',
    ];

    public function rw(): BelongsTo
    {
        return $this->belongsTo(Rw::class, 'nik_rw', 'nik_rw');
    }
}
