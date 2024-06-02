<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan Faker untuk mengisi data
        $faker = Faker::create('id_ID');

        // Ambil semua nik dan nkk yang ada
        $niks = DB::table('penduduk')->pluck('nik')->toArray();
        $nkks = DB::table('penduduk')->pluck('nkk')->toArray();
        $no_rt = DB::table('rt')->pluck('no_rt')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 500) as $index) {
            // Insert data baru ke tabel keluarga
            DB::table('keluarga')->insert([
                'nkk' => $faker->unique()->randomElement($nkks),
                'nik_kepala_keluarga' => $faker->unique()->randomElement($niks),
                'no_rt' => $faker->randomElement($no_rt),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
