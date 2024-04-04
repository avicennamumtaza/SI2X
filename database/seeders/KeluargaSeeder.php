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

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 20) as $index) {
            // Insert data baru ke tabel keluarga
            DB::table('keluarga')->insert([
                'nkk' => $faker->unique()->numerify('3###############'),
                'nik_kepala_keluarga' => $faker->unique()->numerify('35##############'),
                'jumlah_nik' => $faker->numberBetween(3, 8),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
