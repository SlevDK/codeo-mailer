<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class RegistrationTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function test_that_user_can_be_registered()
    {
        $name = $this->faker->firstName;
        $email = $this->faker->safeEmail;

        $response = $this->json('POST', '/api/v1/account/create', [
            'username'  => $name,
            'email'     => $email,
            'password'  => 'password'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'payload' => [
                    'id',
                    'username'
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'username'  => $name,
            'email'     => $email,
        ]);
    }

    public function test_that_user_cant_register_without_name()
    {
        $email = $this->faker->safeEmail;

        $response = $this->json('POST', '/api/v1/account/create', [
            'email'     => $email,
            'password'  => 'password'
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'code' => 21,
                'message' => 'Username required',
            ]);

        $this->assertDatabaseMissing('users', [
            'email'     => $email,
        ]);
    }

    public function test_that_user_cant_register_without_email()
    {
        $response = $this->json('POST', '/api/v1/account/create', [
            'username'  => $this->faker->name,
            'password'  => 'password'
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'code' => 21,
                'message' => 'Email required',
            ]);
    }

    public function test_that_user_cant_register_without_password()
    {
        $response = $this->json('POST', '/api/v1/account/create', [
            'username'  => $this->faker->name,
            'email'     => $this->faker->email
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'code' => 21,
                'message' => 'Password required',
            ]);
    }
}
