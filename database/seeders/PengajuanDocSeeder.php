<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PengajuanDocSeeder extends Seeder
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

        // Ambil semua nkk yang ada
        $nikPengaju = DB::table('penduduk')->pluck('nik')->toArray();
        $idPengajuan = DB::table('dokumen')->pluck('id_pengajuan')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 20) as $index) {
            // Insert data baru ke tabel pengajuan_doc
            DB::table('pengajuan_doc')->insert([
                'nik' => $faker->randomElement($nikPengaju),
                'id_pengajuan' => $faker->randomElement($idPengajuan), // Sesuaikan dengan rentang id_pengajuan yang tersedia
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
