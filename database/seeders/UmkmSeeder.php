<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_umkm' => 2,
                'no_rw' => 6,
                'nik_pemilik' => 3573011233455985,
                'nama_umkm' => 'Risol Dea',
                'foto_umkm' => 'disini/yaaaa',
                'desc_umkm' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'status_umkm' => 'Diterima'
            ]
        ];
        DB::table('umkm')->insert($data);
        // $faker = Faker::create();

        // for ($i = 1; $i < 10; $i++) {
        //     DB::table('umkm')->insert([
        //         'id_umkm' => $i,
        //         'nik_pemilik' => $faker->randomNumber($nbDigits = 16, $strict = true),
        //         'nama_umkm' => $faker->name(),
        //         'foto_umkm' => $faker->text($maxNbChars = 50),
        //         'desc_umkm' => $faker->text($maxNbChars = 50),
        //     ]);
        // }
    }
}
