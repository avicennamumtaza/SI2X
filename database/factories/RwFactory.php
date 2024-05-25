<?php

namespace Database\Factories;

use App\Models\Penduduk;
use App\Models\Rw;
use Illuminate\Database\Eloquent\Factories\Factory;

class RwFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rw::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nik = Penduduk::pluck('nik');
        return [
            'no_rw' => '1',
            'nik_rw' => $nik[990],
            'wa_rw' => $this->faker->numerify('08##########'),
        ];
    }
}

