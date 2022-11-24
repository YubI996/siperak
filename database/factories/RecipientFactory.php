<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipient>
 */
class RecipientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slug' => random_slug(),
            'nama' => fake()->name(),
            'nik' => rand(1110001110101011, 9090909090909099),
            'bd' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'rt' => 405,
            'jenkel' => implode(Arr::random(['Laki-laki', 'Perempuan'], 1)),
            'alamat' => fake()->address(),
            'long' => 117.233178,
            'lat' => -0.584461,
            'foto_penerima' => 'default.png',
            'foto_ktp' => null,
            'foto_kk' => null,
            'foto_rumah' => null,
            'status_rumah' => implode(Arr::random(['Milik Sendiri','Mengontrak/Menyewa','Menumpang'], 1)),
        ];
    }
}
