<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';
    protected $primaryKey = 'id_umkm';
    protected $fillable = [
        'nik_pemilik',
        'nama_umkm',
        'foto_umkm',
        'desc_umkm',
    ];
}
