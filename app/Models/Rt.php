<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rt';
    protected $primaryKey = 'no_rt';
    protected $fillable = [
        'no_rt',
        'nik_rt',
        'wa_rt',
    ];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'nik_rt', 'nik');
    }

    // public function dokumen(): HasMany
    // {
    //     return $this->hasMany(Dokumen::class, 'no_rt', 'no_rt');
    // }

    // RT Model
    public function keluarga()
    {
        return $this->hasMany(Keluarga::class, 'no_rt', 'no_rt');
    }

}
