<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LaporanKeuanganSeeder extends Seeder
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

        // Ambil semua nomor rw yang ada
        $rwNumbers = DB::table('rw')->pluck('no_rw')->toArray();

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 20) as $index) {
            // Insert data baru ke tabel laporan_keuangan
            DB::table('laporan_keuangan')->insert([
                'no_rw' => $faker->randomElement($rwNumbers),
                'nominal' => $faker->randomFloat(2, 1000, 10000),
                'detail_laporan' => $faker->sentence,
                'tanggal_laporan' => $faker->date(),
                'pihak_terlibat' => $faker->name,
                'saldo' => $faker->randomFloat(2, 10000, 50000),
                'is_income' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
