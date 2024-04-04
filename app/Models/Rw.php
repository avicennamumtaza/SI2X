<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rw';
    protected $primaryKey = 'no_rw';
    protected $fillable = [
        'nik_rw',
        'jumlah_rt',
        'jumlah_keluarga_rw',
        'jumlah_penduduk_rw',
    ];
}