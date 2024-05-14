<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = 'keluarga';
    protected $primaryKey = 'nkk';
    protected $fillable = [
        'nkk',
        'nik_kepala_keluarga',
        'no_rt',
    ];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'nik_kepala_keluarga', 'nik');
    }

    public function rt(): BelongsTo
    {
        return $this->belongsTo(Rt::class, 'no_rt', 'no_rt');
    }
}
