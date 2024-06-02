<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $keluargaNkk = DB::table('keluarga')->take(10)->pluck('nkk');

        foreach ($keluargaNkk as $nkk) {
            DB::table('alternatif')->insert([
                'nkk' => $nkk,
                'penghasilan' => rand(1000000, 10000000), // Random value for example
                'tanggungan' => rand(1, 5), // Random value for example
                'pajak_bumibangunan' => rand(50000, 500000), // Random value for example
                'pajak_kendaraan' => rand(100000, 1000000), // Random value for example
                'daya_listrik' => $faker->randomElement([0, 450, 900, 1300, 2200, 3500]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
