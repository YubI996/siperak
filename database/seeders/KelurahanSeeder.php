<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'kec_id' => 1
            ],
            [
                'id' => 2,
                'nama_kel' => 'Gunung Telihan',
                'kec_id' => 1
            ],
            [
                'id' => 3,
                'nama_kel' => 'Kanaan',
                'kec_id' => 1
            ],
            [
                'id' => 4,
                'nama_kel' => 'Berbas Pantai',
                'kec_id' => 2
            ],
            [
                'id' => 5,
                'nama_kel' => 'Berebas Tengah',
                'kec_id' => 2
            ],
            [
                'id' => 6,
                'nama_kel' => 'Bontang Lestari',
                'kec_id' => 2
            ],
            [
                'id' => 7,
                'nama_kel' => 'Satimpo',
                'kec_id' => 2
            ],
            [
                'id' => 8,
                'nama_kel' => 'tanjung Laut',
                'kec_id' => 2
            ],
            [
                'id' => 9,
                'nama_kel' => 'Tanjung Laut Indah',
                'kec_id' => 2
            ],
            [
                'id' => 10,
                'nama_kel' => 'Api-api',
                'kec_id' => 3
            ],
            [
                'id' => 11,
                'nama_kel' => 'Bontang Baru',
                'kec_id' => 3
            ],
            [
                'id' => 12,
                'nama_kel' => 'Bontang Kuala',
                'kec_id' => 3
            ],
            [
                'id' => 13,
                'nama_kel' => 'Gunung Elai',
                'kec_id' => 3
            ],
            [
                'id' => 14,
                'nama_kel' => 'Guntung',
                'kec_id' => 3
            ],
            [
                'id' => 15,
                'nama_kel' => 'Loktuan',
                'kec_id' => 3
            ],
        ]);
    }
}
