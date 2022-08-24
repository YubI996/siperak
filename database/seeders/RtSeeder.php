<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rt =
        [
            '1' => 51,
            '2' => 30,
            '3' => 12,
            '4' => 24,
            '5' => 62,
            '6' => 19,
            '7' => 25,
            '8' => 38,
            '9' => 33,
            '10' => 42,
            '11' => 28,
            '12' => 20,
            '13' => 45,
            '14' => 18,
            '15' => 52
        ];
        foreach($rt as $k=>$v)
        {
            for ($i=1; $i <= $v ; $i++) {
                DB::table('rts')->insert([
                    'nama_rt' => $i,
                    'kel_id' => $k
                ]);
            }
        }
    }
}
