<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TweetTest extends TestCase
{

    public function testSuccessfulCreateTweet()
    {
        $faker = \Faker\Factory::create();
        $tweet = [
            "tweet" => $faker->sentence(),
        ];

        $user = User::inRandomOrder()->first();
        $token = $user->createToken("tweet")->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                        ->json('POST', 'api/v1/tweets', $tweet, ['Accept' => 'application/json'])
                        ->assertStatus(201)
                            ->assertJsonStructure([
                                "data" => [
                                    'id',
                                    'tweet',
                                    "user" => [
                                        'id',
                                        'name',
                                        'email',
                                        'birth_date',
                                        'image',
                                    ],
                                ]
                            ]);
    }
}
