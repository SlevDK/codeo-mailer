<?php

namespace Tests\Feature;

use App\Exceptions\Api\ErrorException;
use App\Exceptions\Api\NotFoundException;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_that_user_can_retrieve_token()
    {
        $user = factory(User::class)->create();

        $response = $this->json('post', '/api/v1/account/token-obtain', [
            'email' => $user->email,
            'password' => 'password' // factory hardcoded password
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'token' => $user->api_token
            ]);
    }

    public function test_that_user_cant_retrieve_token_with_wrong_password()
    {
        $user = factory(User::class)->create();

        $response = $this->json('post', '/api/v1/account/token-obtain', [
            'email' => $user->email,
            'password' => 'password1'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                "non_field_errors" => [
                    "Unable to log in with provided credentials."
                ]
            ]);
    }

    public function test_user_not_found_response_with_non_exists_email()
    {
        $response = $this->json('post', '/api/v1/account/token-obtain', [
            'email' => 'none@exists.email',
            'password' => 'password'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                "non_field_errors" => [
                    "Unable to log in with provided credentials."
                ]
            ]);
    }
}
