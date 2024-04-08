<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanDokumen extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_dokumen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nik',
        'id_pengajuan',
    ];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'nik', 'nik');
    }

    public function dokumen(): BelongsTo
    {
        return $this->belongsTo(Dokumen::class, 'id_pengajuan', 'id_pengajuan');
    }
}
