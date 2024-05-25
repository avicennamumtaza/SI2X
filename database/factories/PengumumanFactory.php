<?php

namespace Database\Factories;

use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengumumanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pengumuman::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(5),
            'tanggal' => $this->faker->date(),
            'deskripsi' => $this->faker->paragraph(3),
            'foto_pengumuman' => $this->faker->imageUrl(), // You can modify this according to your needs
        ];
    }
}

