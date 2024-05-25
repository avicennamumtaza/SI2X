<?php

namespace Database\Factories;

use App\Models\Penduduk;
use App\Models\Rt;
use Illuminate\Database\Eloquent\Factories\Factory;

class RtFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nik = Penduduk::pluck('nik');
        return [
            'no_rt' => '17',
            'nik_rt' => $nik[990],
            'wa_rt' => '088976543290',
        ];
    }
}

