<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';
    protected $primaryKey = 'id_umkm';
    protected $fillable = [
        'nik_pemilik',
        'nama_umkm',
        'alamat_umkm',
        'wa_umkm',
        'foto_umkm',
        'deskripsi_umkm',
        'status_umkm',
    ];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'nik_pemilik', 'nik');
    }

    // public function rw(): BelongsTo
    // {
    //     return $this->belongsTo(Rw::class, 'nik_pemilik', 'nik_rw');
    // }

    public static function deleteUmkmDitolak()
    {
        $oneMonthAgo = Carbon::now()->subMonth();
        $umkms = Umkm::where('status_umkm', 'Ditolak')
            ->where('updated_at', '<', $oneMonthAgo)
            ->get();
        foreach ($umkms as $umkm) {
            $umkm->delete();
        }
    }
}
