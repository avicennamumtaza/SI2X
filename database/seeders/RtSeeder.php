<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 16) as $index) {
            $randomPenduduk = Penduduk::where('no_rt', $index)->first()->toArray();
            // $singleCaRt = Penduduk::all()->toArray();
            // dd($randomPenduduk['no_rt']);
            DB::table('rt')->insert([
                'no_rt' => $randomPenduduk['no_rt'],
                'nik_rt' => $randomPenduduk['nik'],
                'wa_rt' => $faker->unique()->numerify('08##########'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
