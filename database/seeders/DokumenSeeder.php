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
        foreach (range(1, 3) as $index) {
            // Insert data baru ke tabel dokumen
            DB::table('dokumen')->insert([
                'jenis_dokumen' => $faker->unique()->randomElement(['SKTM', 'Surat Kematian', 'Surat Pengantar']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}