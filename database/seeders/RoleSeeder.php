<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1,'nama' => 'admin_super'],
            ['id' => 2,'nama' => 'walikota'],
            ['id' => 3,'nama' => 'admin1'],
            ['id' => 4,'nama' => 'admin2'],
            ['id' => 5,'nama' => 'kecamatan'],
            ['id' => 6,'nama' => 'kelurahan'],
            ['id' => 7,'nama' => 'pokmas'],
            ['id' => 8,'nama' => 'juru_antar']
        ]);
    }
}
