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
        $faker = Faker::create();

        $faker = Faker::create();
        $saldo = 0;
        $entries = [];
        
        foreach (range(1, 20) as $index) {
            $entries[] = [
                'status_pemasukan' => $faker->boolean(),
                'nominal' => $faker->numberBetween(1000, 100000000),
                'tanggal' => $faker->dateTimeThisDecade(),
                'pihak_terlibat' => $faker->name(),
                'detail' => $faker->sentence(5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        usort($entries, function ($a, $b) {
            return $a['tanggal'] <=> $b['tanggal'];
        });
        
        foreach ($entries as &$entry) {
            if ($entry['status_pemasukan']) {
                $saldo += $entry['nominal'];
            } else {
                // Pastikan saldo tidak menjadi negatif
                $saldo -= $entry['nominal'];
                if ($saldo < 0) {
                    $saldo = 0;
                }
            }
            $entry['saldo'] = $saldo;
        
            DB::table('laporan_keuangan')->insert($entry);
        }
    }
}