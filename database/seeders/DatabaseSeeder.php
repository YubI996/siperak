<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            KecamatanSeeder::class,
            kelurahanSeeder::class,
            RtTableSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Darius Gaines',
            'email' => 'cybusupup@mailinator.com',
            'role' => '1',
            'password' => '$2y$10$Y1jYmrR/8RL/ySnVt/uC8OohXNdyXjt6R85nm1xBMJaHMnsulkPWa',
        ]);
    }
}
