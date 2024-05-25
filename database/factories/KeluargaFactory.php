<?php

namespace Database\Factories;

use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeluargaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Keluarga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nik = Penduduk::pluck('nik');
        return [
            'nkk' => $this->faker->numerify('################'),
            'nik_kepala_keluarga' => $nik[990],
            'no_rt' => '10',
        ];
    }
}

