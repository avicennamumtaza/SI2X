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

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 10) as $index) {
            // Insert data baru ke tabel dokumen
            DB::table('dokumen')->insert([
                'jenis_dokumen' => $faker->unique()->randomElement(['Surat Pengantar', 'Surat Pindah', 'Surat Cerai', 'Surat Nikah', 'Surat Keterangan Usaha', 'Surat Keterangan Tidak Mampu', 'Surat Keterangan Domisili', 'Surat Keterangan Lahir', 'Surat Keterangan Kematian', 'Surat Keterangan Belum Menikah']),
                'deskripsi' => $faker->sentence(5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
