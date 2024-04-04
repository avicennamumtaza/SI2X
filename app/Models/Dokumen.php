<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'umkm';
    protected $primaryKey = 'id_pengajuan';
    protected $fillable = [
        'no_rt',
        'nik_pengaju',
        'jenis_dokumen',
        'status_pengajuan',
        'catatan',
        'tanggal_pengajuan',
        'nama_pengaju',
        'tanggal_pengajuan',
    ];
}