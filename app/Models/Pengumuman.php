<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'foto_pengumuman',
    ];

    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('foto_pengumuman')->url($this->foto_pengumuman),
        );
    }

    // public function rw(): BelongsTo
    // {
    //     return $this->belongsTo(Rw::class, 'no_rw', 'no_rw');
    // }
}
