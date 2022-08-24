<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelurahans')->insert([
            [
                'id' => 1,
                'nama_kel' => 'Belimbing',
                'kecamatan_id' => 1
            ],
            [
                'id' => 2,
                'nama_kel' => 'Gunung Telihan',
                'kecamatan_id' => 1
            ],
            [
                'id' => 3,
                'nama_kel' => 'Kanaan',
                'kecamatan_id' => 1
            ],
            [
                'id' => 4,
                'nama_kel' => 'Berbas Pantai',
                'kecamatan_id' => 2
            ],
            [
                'id' => 5,
                'nama_kel' => 'Berebas Tengah',
                'kecamatan_id' => 2
            ],
            [
                'id' => 6,
                'nama_kel' => 'Bontang Lestari',
                'kecamatan_id' => 2
            ],
            [
                'id' => 7,
                'nama_kel' => 'Satimpo',
                'kecamatan_id' => 2
            ],
            [
                'id' => 8,
                'nama_kel' => 'tanjung Laut',
                'kecamatan_id' => 2
            ],
            [
                'id' => 9,
                'nama_kel' => 'Tanjung Laut Indah',
                'kecamatan_id' => 2
            ],
            [
                'id' => 10,
                'nama_kel' => 'Api-api',
                'kecamatan_id' => 3
            ],
            [
                'id' => 11,
                'nama_kel' => 'Bontang Baru',
                'kecamatan_id' => 3
            ],
            [
                'id' => 12,
                'nama_kel' => 'Bontang Kuala',
                'kecamatan_id' => 3
            ],
            [
                'id' => 13,
                'nama_kel' => 'Gunung Elai',
                'kecamatan_id' => 3
            ],
            [
                'id' => 14,
                'nama_kel' => 'Guntung',
                'kecamatan_id' => 3
            ],
            [
                'id' => 15,
                'nama_kel' => 'Loktuan',
                'kecamatan_id' => 3
            ],
        ]);
    }
}
