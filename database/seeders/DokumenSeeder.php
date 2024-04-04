<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DokumenSeeder extends Seeder
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

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 20) as $index) {
            // Insert data baru ke tabel dokumen
            DB::table('dokumen')->insert([
                'no_rt' => $faker->randomElement($noRt), // Sesuaikan dengan rentang nomor RT yang tersedia
                'nik_pengaju' => $faker->unique()->numerify('35##############'),
                'jenis_dokumen' => $faker->randomElement(['SKTM', 'Surat Kematian', 'Surat Pengantar']),
                'status_pengajuan' => $faker->randomElement(['Baru', 'Disetujui', 'Ditolak']),
                'catatan' => $faker->text,
                'nama_pengaju' => $faker->name,
                'tanggal_pengajuan' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
