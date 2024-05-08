<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PengumumanSeeder extends Seeder
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
        foreach (range(1, 10) as $index) {
            // Pilih nomor rw secara acak
            // $noRw = $faker->randomElement($rwNumbers);

            // Insert data baru ke tabel pengumuman
            DB::table('pengumuman')->insert([
                // 'no_rw' => $noRw,
                'judul' => $faker->sentence(3),
                'tanggal' => $faker->date(),
                'deskripsi' => $faker->paragraph(3),
                'foto_pengumuman' => $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
