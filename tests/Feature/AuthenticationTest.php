<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    public function testSuccessfulRegistration()
    {
        $faker = \Faker\Factory::create();

        $userData = [
            "name" => $faker->name(),
            "email" => $faker->email(),
            "password" => "password",
            "birth_date" => $faker->date(),
        ];

        $this->json('POST', 'api/v1/auth/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    "user" => [
                        'id',
                        'name',
                        'email',
                        'birth_date',
                        'image',
                    ],
                    "access_token",
                ]
            ]);
    }

    public function testSuccessfulLogin()
    {
        $loginData = ['email' => User::inRandomOrder()->first()->email,'password' => "password"];
        $this->json('POST', 'api/v1/auth/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "user" => [
                        'id',
                        'name',
                        'email',
                        'birth_date',
                        'image',
                    ],
                    "access_token",
                ]
            ]);

        $this->assertAuthenticated();
    }
}
