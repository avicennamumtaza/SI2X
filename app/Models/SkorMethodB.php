<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorMethodB extends Model
{
    use HasFactory;
    protected $table = 'skor_method_b';
    protected $primaryKey = 'nkk';
    protected $fillable = [
        'nkk',
        'skor',
        // 'isBenefit',
    ];
}
