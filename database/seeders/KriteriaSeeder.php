<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = [
            ['nama_ktr' => 'penghasilan', 'bobot_ktr' => 5, 'isBenefit' => 1],
            ['nama_ktr' => 'tanggungan', 'bobot_ktr' => 5, 'isBenefit' => 0],
            ['nama_ktr' => 'pajak_bumibangunan', 'bobot_ktr' => 2, 'isBenefit' => 1],
            ['nama_ktr' => 'pajak_kendaraan', 'bobot_ktr' => 3, 'isBenefit' => 1],
            ['nama_ktr' => 'daya_listrik', 'bobot_ktr' => 4, 'isBenefit' => 1],
        ];

        DB::table('kriteria')->insert($kriteria);
    }
}
