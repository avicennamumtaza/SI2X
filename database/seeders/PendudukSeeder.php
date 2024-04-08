<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PendudukSeeder extends Seeder
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
        foreach (range(1, 40) as $index) {
            // Insert data baru ke tabel penduduk
            DB::table('penduduk')->insert([
                'nik' => $faker->unique()->numerify('################'),
                'nkk' => $faker->numerify('################'),
                'no_rt' => $faker->numberBetween(1, 16),
                'nama' => $faker->name(),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date(),
                'alamat' => $faker->address(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'pekerjaan' => $faker->jobTitle(),
                'gol_darah' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'is_married' => $faker->boolean(),
                'is_stranger' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
