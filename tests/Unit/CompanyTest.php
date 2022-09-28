<?php

namespace Tests\Unit;

use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyTest extends TestCase
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
        $response->get('api/admin/company')
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
                                "id",
                                "name",
                                "email",
                                "logo",
                                "website",
                                "created_at",
                                "updated_at"
                            ]
                        ],
                        'first_page_url',
                        "from",
                        "last_page",
                        "last_page_url",
                        "links" => [
                            '*' => [
                                'url',
                                'label',
                                'active'
                            ]
                        ],
                        "next_page_url",
                        "path",
                        "per_page",
                        "prev_page_url",
                        "to",
                        "total"
                    ],

                ]
            );
    }
    public function test_create()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        Storage::fake('images');
        $data = [
            "name" => "Empresita",
            "email" => "empresita@gmaaisl.com",
            "logo" => HttpUploadedFile::fake()->image('avatar.jpg', 150, 150),
            "website" => 'http://theoffice.com'
        ];
        $response->post('api/admin/company', $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "status",
                    "code",
                    "msg",
                    "data" => [
                        "name",
                        "logo",
                        "email",
                        "website",
                        "updated_at",
                        "created_at",
                        "id",
                    ]
                ]
            );
    }
    public function test_show_one()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        Storage::fake('images');
        $data = [
            "name" => "Empresita",
            "email" => "empresita@gmaaisl.com",
            "logo" => HttpUploadedFile::fake()->image('avatar.jpg', 150, 150),
            "website" => 'http://theoffice.com'
        ];
        $response->get('api/admin/company/1', $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "status",
                    "code",
                    "msg",
                    "data" => [
                        "id",
                        "name",
                        "email",
                        "logo",
                        "website",
                        "created_at",
                        "updated_at"
                    ]
                ]
            );
    }

    public function test_update()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        $response->put('api/admin/company/1')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "status",
                    "code",
                    "msg",
                    "data" => [
                        "id",
                        "name",
                        "email",
                        "logo",
                        "website",
                        "created_at",
                        "updated_at"
                    ]
                ]
            );
    }

    public function test_delete()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->actingAs($user);
        $response->delete('api/admin/company/1')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "status",
                    "code",
                    "msg",
                    "data" => [
                        "id",
                        "name",
                        "email",
                        "logo",
                        "website",
                        "created_at",
                        "updated_at"
                    ]
                ]
            );
    }
}
