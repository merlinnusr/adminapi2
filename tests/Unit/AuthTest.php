<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $data = [
            'email' => $user->email,
            'password' => 'password',

        ];
        $this->post(route('login'), $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'access_token',
                    'token_type',
                    'expires_in',
                ]
            );
    }
}
