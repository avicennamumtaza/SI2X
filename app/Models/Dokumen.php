<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $fillable = [
        // 'id_dokumen',
        'jenis_dokumen',
        'deskripsi'
    ];

    public function dokumen(): HasMany
    {
        return $this->hasMany(PengajuanDokumen::class, 'id_dokumen', 'id_dokumen');
    }
}
