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
        // $data = [
        //     [
        //         'id_umkm' => 2,
        //         'no_rw' => 6,
        //         'nik_pemilik' => 3573011233455985,
        //         'nama_umkm' => 'Risol Dea',
        //         'foto_umkm' => 'disini/yaaaa',
        //         'desc_umkm' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        //         'status_umkm' => 'Diterima'
        //     ]
        // ];
        // DB::table('umkm')->insert($data);
        
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('umkm')->insert([
                'no_rw' => $faker->numberBetween(1, 100),
                'nik_pemilik' => $faker->numerify('################'),
                'nama_umkm' => $faker->company,
                'wa_umkm' => $faker->numerify('08##########'),
                'foto_umkm' => $faker->imageUrl(),
                'desc_umkm' => $faker->paragraph,
                'status_umkm' => $faker->randomElement(['Diterima', 'Ditolak', 'Baru']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
