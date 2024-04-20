<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $fillable = [
        'jenis_dokumen',
    ];

    public function rt(): BelongsTo
    {
        return $this->belongsTo(Rt::class, 'no_rt', 'no_rt');
    }

    public function pengajuan(): HasMany
    {
        return $this->hasMany(PengajuanDokumen::class, 'id_pengajuan', 'id_pengajuan');
    }
}
