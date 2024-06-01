<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $primaryKey = 'id_ktr';
    protected $fillable = [
        'nama_ktr',
        'bobot_ktr',
        'isBenefit',
    ];
}
