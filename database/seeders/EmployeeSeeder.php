<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = User::whereEmail('empleado@empleado.com')
        ->first();
        Employee::create([
            'user_id' => $employee->id,
            'company_id' => 1,
            'phone' => '3314137850',
        ]);
    }
}
