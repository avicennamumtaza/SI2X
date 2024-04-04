<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}