<?php

namespace Database\Factories;

use App\Models\Penduduk;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Users::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nik = Penduduk::pluck('nik');
        // dd($nik[90]);
        return [
            'nik' => $nik[990], // generate unique 17-digit number
            'username' => $this->faker->userName,
            'role' => $this->faker->randomElement(['Rw']),
            'foto_profil' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // You can customize the default password
        ];
    }
}
