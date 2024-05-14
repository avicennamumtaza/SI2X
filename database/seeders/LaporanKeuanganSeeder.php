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

        // Loop untuk mengisi data sebanyak yang diinginkan
        foreach (range(1, 20) as $index) {
            // Insert data baru ke tabel laporan_keuangan
            DB::table('laporan_keuangan')->insert([
                'status_pemasukan' => $faker->boolean(),
                'nominal' => $faker->numberBetween(1000, 100000000),
                'tanggal' => $faker->date(),
                'pihak_terlibat' => $faker->name(),
                'detail' => $faker->sentence(5),
                'saldo' => $faker->numberBetween(0, 100000000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
