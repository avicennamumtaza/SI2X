<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SkorMethodA extends Model
{
    use HasFactory;
    protected $table = 'skor_method_a';
    protected $primaryKey = 'nkk';
    protected $fillable = [
        'nkk',
        'skor',
        // 'isBenefit',
    ];
    public function alternatif(): HasOne {
        return $this->hasOne(Alternatif::class, 'nkk', 'nkk');
    }
}
