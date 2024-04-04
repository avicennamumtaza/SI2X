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

        // Ambil semua nkk yang ada
        $nkk = DB::table('keluarga')->pluck('nkk')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 20) as $index) {
            // Insert data baru ke tabel penduduk
            DB::table('penduduk')->insert([
                'nik' => $faker->unique()->numerify('35##############'),
                'nkk' => $faker->randomElement($nkk),
                'no_rt' => $faker->numerify('#'),
                'nama' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date(),
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'pekerjaan' => $faker->sentence(2, true),
                'gol_darah' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'is_married' => $faker->boolean(),
                'is_stranger' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
