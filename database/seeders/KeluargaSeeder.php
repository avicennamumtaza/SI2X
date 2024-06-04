<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uniqueNkkPendudukCollection = DB::table('penduduk')
            ->select('penduduk.nkk', 'penduduk.nik', 'penduduk.no_rt')
            ->whereIn('penduduk.nkk', function ($query) {
                $query->select('nkk')
                      ->from('penduduk')
                      ->groupBy('nkk');
            })
            ->get();

        foreach ($uniqueNkkPendudukCollection as $penduduk) {
            $exists = DB::table('keluarga')->where('nkk', $penduduk->nkk)->exists();
            
            if (!$exists) {
                DB::table('keluarga')->insert([
                    'nkk' => $penduduk->nkk,
                    'nik_kepala_keluarga' => $penduduk->nik,
                    'no_rt' => $penduduk->no_rt,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // $faker = Faker::create('id_ID');
        // foreach (range(1, 300) as $index) {
        // }

        // $randomPendudukCollection = Penduduk::inRandomOrder()->take(300)->get();
        // $randomPendudukArray = $randomPendudukCollection->toArray();

        // // $niks = DB::table('penduduk')->all()->toArray();
        // // $penduduks = Penduduk::all()->toArray();
        // // dd($penduduks);

        // foreach ($randomPendudukArray as $index => $penduduk) {
        //     // $randomPenduduk = Penduduk::inRandomOrder()->first()->toArray();
        //     // dd($penduduk['nkk']);
        //     DB::table('keluarga')->insert([
        //         'nkk' => $penduduk['nkk'],
        //         'nik_kepala_keluarga' => $penduduk['nik'],
        //         'no_rt' => $penduduk['no_rt'],
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
