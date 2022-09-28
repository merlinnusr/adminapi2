<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Employee;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'employee']);
        User::whereEmail('admin@admin.com')
        ->first()
        ->assignRole('admin');

        User::whereEmail('empleado@empleado.com')
        ->first()
        ->assignRole('employee');
    }
}
