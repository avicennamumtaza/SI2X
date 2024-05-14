<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
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
        $nikRt = DB::table('rt')->pluck('nik_rt')->toArray();
        $nikRw = DB::table('rw')->pluck('nik_rw')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 20) as $index) {
            // Insert data baru ke tabel users
            DB::table('users')->insert([
                'nik' => $faker->randomElement($nikRt,$nikRw),
                'username' => $faker->userName(),
                'role' => $faker->randomElement(['RW', 'RT']),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'), // Default password
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

