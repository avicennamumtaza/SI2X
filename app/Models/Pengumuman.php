<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'foto',
    ];

    // public function rw(): BelongsTo
    // {
    //     return $this->belongsTo(Rw::class, 'no_rw', 'no_rw');
    // }
}