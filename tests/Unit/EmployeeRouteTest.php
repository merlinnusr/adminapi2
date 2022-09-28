<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class EmployeeRouteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_me()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        Employee::create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'phone' => '3314137850',
        ]);
        $user->assignRole('employee');
        $response = $this->actingAs($user);
        $response->get(route('employees.me'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'id',
                    'name',
                    'last_name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                    'roles' => [
                        '*' => [
                            'id',
                            'name',
                            'guard_name',
                            'created_at',
                            'updated_at',
                            'pivot' => [
                                'model_id',
                                'role_id',
                                'model_type',
                            ],
                        ],

                    ],
                ]
            );
    }
}
