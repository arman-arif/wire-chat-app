<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory(10)->create();
        User::create([
            'name' => 'Arman',
            'username' => 'arman',
            'email' => 'arman@gmail.com',
            'password' => bcrypt('arman'),
        ]);
        User::create([
            'name' => 'Emon',
            'username' => 'emon',
            'email' => 'emon@gmail.com',
            'password' => bcrypt('emon'),
        ]);
    }
}
