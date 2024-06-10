<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class SetTitle
{
    public function handle($request, Closure $next)
    {
        $routeName = Route::currentRouteName();
        $titles = [
            'landing' => 'Beranda',
            'home' => 'Dashboard',
            'umkm.global' => 'UMKM',
            'umkm.store' => 'Tambah UMKM',
            'bansos.global' => 'Bansos',
            'bansos.store' => 'Tambah Bansos',
            'bansos.manage' => 'Kelola Bansos',
            'bansos.destroy' => 'Hapus Bansos',
            'pengajuandokumen.store' => 'Pengajuan Dokumen',
            'pengajuandokumen.global' => 'Pengajuan Dokumen',
            'pengumuman.global' => 'Pengumuman',
            'laporankeuangan.global' => 'Laporan Keuangan',
            'pengumuman.manage' => 'Kelola Pengumuman',
            'pengumuman.store' => 'Tambah Pengumuman',
            'pengumuman.edit' => 'Edit Pengumuman',
            'pengumuman.update' => 'Update Pengumuman',
            'pengumuman.destroy' => 'Hapus Pengumuman',
            'pengumuman.hapus-lama' => 'Hapus Pengumuman Lama',
            'pengajuandokumen.manage' => 'Kelola Pengajuan Dokumen',
            'pengajuandokumen.edit' => 'Edit Pengajuan Dokumen',
            'pengajuandokumen.update' => 'Update Pengajuan Dokumen',
            'pengajuandokumen.destroy' => 'Hapus Pengajuan Dokumen',
            'laporankeuangan.manage' => 'Kelola Laporan Keuangan',
            'laporankeuangan.store' => 'Tambah Laporan Keuangan',
            'laporankeuangan.edit' => 'Edit Laporan Keuangan',
            'laporankeuangan.update' => 'Update Laporan Keuangan',
            'laporankeuangan.destroy' => 'Hapus Laporan Keuangan',
            'laporankeuangan.export' => 'Export Laporan Keuangan',
            'umkm.manage' => 'Kelola UMKM',
            'umkm.edit' => 'Edit UMKM',
            'umkm.update' => 'Update UMKM',
            'umkm.destroy' => 'Hapus UMKM',
            'rt.manage' => 'Kelola RT',
            'rt.store' => 'Tambah RT',
            'rt.edit' => 'Edit RT',
            'rt.update' => 'Update RT',
            'rt.destroy' => 'Hapus RT',
            'rt.show' => 'Detail RT',
            'rw.manage' => 'Kelola RW',
            'rw.edit' => 'Edit RW',
            'rw.update' => 'Update RW',
            'rw.store' => 'Tambah RW',
            'rw.destroy' => 'Hapus RW',
            'penduduk.manage' => 'Kelola Penduduk',
            'penduduk.store' => 'Tambah Penduduk',
            'penduduk.edit' => 'Edit Penduduk',
            'penduduk.update' => 'Update Penduduk',
            'penduduk.destroy' => 'Hapus Penduduk',
            'penduduk.export' => 'Export Penduduk',
            'penduduk.import' => 'Import Penduduk',
            'penduduk.show' => 'Detail Penduduk',
            'keluarga.manage' => 'Kelola Keluarga',
            'keluarga.store' => 'Tambah Keluarga',
            'keluarga.edit' => 'Edit Keluarga',
            'keluarga.update' => 'Update Keluarga',
            'keluarga.destroy' => 'Hapus Keluarga',
            'keluarga.anggota' => 'Detail Anggota Keluarga',
            'users.manage' => 'Kelola Pengguna',
            'users.store' => 'Tambah Pengguna',
            'users.update' => 'Update Pengguna',
            'users.destroy' => 'Hapus Pengguna',
            'dokumen.manage' => 'Kelola Dokumen',
            'dokumen.store' => 'Tambah Dokumen',
            'dokumen.edit' => 'Edit Dokumen',
            'dokumen.update' => 'Update Dokumen',
            'dokumen.destroy' => 'Hapus Dokumen',
            'lansia' => 'Penduduk Lansia',
            'produktif' => 'Penduduk Produktif',
            'anak' => 'Penduduk Anak',
            'profil.manage' => 'Kelola Profil',
            'profil.update' => 'Update Profil',
            'profil.foto' => 'Update Foto Profil',
            'maut.result' => 'Hasil SPK MAUT',
            'maut.export' => 'Export Hasil SPK MAUT',
            'mfep.result' => 'Hasil SPK MFEP',
            'mfep.export' => 'Export Hasil SPK MFEP',
        ];

        view()->share('pageTitle', $titles[$routeName] ?? config('app.name', 'SIRW'));

        return $next($request);
    }
}
