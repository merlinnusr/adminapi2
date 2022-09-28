<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'Empleado',
            'last_name' => 'Empleado',
            'email' => 'empleado@empleado.com',
            'password' => bcrypt('password'),
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
