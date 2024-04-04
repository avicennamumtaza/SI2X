<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDoc extends Model
{
    use HasFactory;
    
    protected $table = 'pengajuan_doc';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nik',
        'id_pengajuan',
    ];
}