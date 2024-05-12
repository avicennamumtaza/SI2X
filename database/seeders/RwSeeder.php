<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RwSeeder extends Seeder
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

        // Menghitung jumlah baris pada tabel rt, keluarga, penduduk
        // $jumlahRt = DB::table('rt')->count();
        // $jumlahRt = DB::table('keluarga')->count();
        // $jumlahRt = DB::table('penduduk')->count();

        // Ambil semua nik yang ada
        $nikRw = DB::table('penduduk')->pluck('nik')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 1) as $index) {
            // Insert data baru ke tabel rw
            DB::table('rw')->insert([
                'no_rw' => 6,
                'nik_rw' => $faker->randomElement($nikRw),
                'wa_rw' => $faker->unique()->numerify('08##########'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
