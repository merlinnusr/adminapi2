<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        $response->get(route('employee.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'status',
                    'code',
                    'msg',
                    'data' => [
                        'current_page',
                        'data' => [
                            '*' => [
                                'id',
                                'user_id',
                                'company_id',
                                'phone',
                                'created_at',
                                'updated_at',
                                'user' => [
                                    'id',
                                    'name',
                                    'last_name',
                                    'email',
                                    'email_verified_at',
                                    'created_at',
                                    'updated_at',
                                ],
                            ],
                        ],
                        'first_page_url',
                        'from',
                        'last_page',
                        'last_page_url',
                        'links' => [
                            '*' => [
                                'url',
                                'label',
                                'active',
                            ],
                        ],
                        'next_page_url',
                        'path',
                        'per_page',
                        'prev_page_url',
                        'to',
                        'total',
                    ],

                ]
            );
    }

    public function test_create()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        $data = [
            'name' => 'jorge',
            'email' => 'jorgit@g.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'last_name' => 'Pastor',
            'company_id' => 1,
            'phone' => 3314137850,
        ];
        $response->post(route('employee.store'), $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'status',
                    'code',
                    'msg',
                    'data' => [
                        'user_id',
                        'company_id',
                        'phone',
                        'updated_at',
                        'created_at',
                        'id',
                    ],
                ]
            );
    }

    public function test_show_one()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        $response->get(route('employee.show', ['employee' => 1]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'status',
                    'code',
                    'msg',
                    'data' => [
                        'user_id',
                        'company_id',
                        'phone',
                        'updated_at',
                        'created_at',
                        'id',
                    ],
                ]
            );
    }

    public function test_update()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        $response->put(route('employee.update', ['employee' => 1]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'status',
                    'code',
                    'msg',
                    'data' => [
                        'id',
                        'user_id',
                        'company_id',
                        'phone',
                        'created_at',
                        'updated_at',
                        'user' => [
                            'id',
                            'name',
                            'last_name',
                            'email',
                            'email_verified_at',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ]
            );
    }

    public function test_delete()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        $response->delete(route('employee.destroy', ['employee' => 1]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'status',
                    'code',
                    'msg',
                    'data' => [
                        'id',
                        'user_id',
                        'company_id',
                        'phone',
                        'created_at',
                        'updated_at',
                        'user' => [
                            'id',
                            'name',
                            'last_name',
                            'email',
                            'email_verified_at',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ]
            );
    }
}
