<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RtSeeder extends Seeder
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
        $nikRt = DB::table('penduduk')->pluck('nik')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 16) as $index) {
            // Insert data baru ke tabel rt
            DB::table('rt')->insert([
                'no_rt' => $faker->unique()->numberBetween(1, 16),
                'nik_rt' => $faker->randomElement($nikRt),
                'wa_rt' => $faker->unique()->numerify('08##########'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
