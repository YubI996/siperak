<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipient as r;
use App\Models\User as u;
use Illuminate\Support\Arr;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'recipient' => r::all()->random()->id,
            'status_trima' =>  implode(Arr::random(['Diajukan','Menerima','Menolak','Pindah','Meninggal','Dihapus'], 1)),
            'alasan' =>  fake()->text(),
            'actor' =>   u::all()->random()->id,
        ];
    }
}
