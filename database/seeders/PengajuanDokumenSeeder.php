<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PengajuanDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan Faker untuk mengisi data
        $faker = Faker::create();

        // Ambil semua nik yang ada
        $noRt = DB::table('rt')->pluck('no_rt')->toArray();
        $idDokumen = DB::table('dokumen')->pluck('id_dokumen')->toArray();
        $nikPengaju = DB::table('penduduk')->pluck('nik')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 20) as $index) {
            // Insert data baru ke tabel pengajuan_dokumen
            DB::table('pengajuan_dokumen')->insert([
                'no_rt' => $faker->randomElement($noRt),
                'id_dokumen' => $faker->randomElement($idDokumen),
                'nik_pengaju' => $faker->randomElement($nikPengaju),
                'nama_pengaju' => $faker->name(),
                'status_pengajuan' => $faker->randomElement(['Baru', 'Disetujui', 'Ditolak']),
                'catatan' => $faker->sentence(5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}