<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rt';
    protected $primaryKey = 'no_rt';
    protected $fillable = [
        'nik_rt',
        'jumlah_keluarga_rt',
        'jumlah_penduduk_rt',
    ];
}