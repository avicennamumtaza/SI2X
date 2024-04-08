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
        $faker = Faker::create();

        // Ambil semua nik yang ada
        $nik = DB::table('penduduk')->pluck('nik')->toArray();
        
        // Ambil semua nkk yang ada
        $nkk = DB::table('penduduk')->pluck('nkk')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 10) as $index) {
            // Insert data baru ke tabel keluarga
            DB::table('keluarga')->insert([
                'nkk' => $faker->unique()->randomElement($nkk),
                'nik_kepala_keluarga' => $faker->unique()->randomElement($nik),
                'jumlah_nik' => $faker->numberBetween(2, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
