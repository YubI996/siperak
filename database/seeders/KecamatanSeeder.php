<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kecamatans')->insert([
            [
                'id' => 1,
                'nama_kec' => 'Bontang Barat',
            ],
            [
                'id' => 2,
                'nama_kec' => 'Bontang Selatan',
            ],
            [
                'id' => 3,
                'nama_kec' => 'Bontang Utara',
            ]
        ]);
    }
}
