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
        'jenis_dokumen',
        'deskripsi_dokumen'
    ];

    public function dokumen(): HasMany
    {
        return $this->hasMany(PengajuanDokumen::class, 'id_dokumen', 'id_dokumen');
    }
}
