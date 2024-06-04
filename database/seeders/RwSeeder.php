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
        $faker = Faker::create();
        $nikRw = DB::table('penduduk')->pluck('nik')->toArray();

        foreach (range(1, 1) as $index) {
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
