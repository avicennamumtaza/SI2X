<?php

namespace Database\Factories;

use App\Models\PengajuanDokumen;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengajuanDokumenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PengajuanDokumen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_dokumen' => function () {
                return \App\Models\Dokumen::factory()->create()->id_dokumen;
            },
            'nik_pengaju' => $this->faker->unique()->numerify('#################'), // generate unique 17-digit number
            'status_pengajuan' => $this->faker->randomElement(['Baru', 'Disetujui', 'Ditolak']),
            'keperluan' => $this->faker->text(),
            'catatan' => $this->faker->text(),
        ];
    }
}
