<?php

use App\Models\User;

it('should be able login with valid credentials', function () {
    User::factory()->create([
        'email'    => 'test@example.com',
        'password' => 'password123',
    ]);

    $response = $this->postJson(route('api.login'), [
        'email'    => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'email',
        ],
        'access_token',
        'token_type',
    ]);
});

it('returns an error with invalid credentials', function () {
    $response = $this->postJson(route('api.login'), [
        'email'    => 'invalid@example.com',
        'password' => 'invalidpassword',
    ]);

    $response->assertStatus(401);
    $response->assertJson([
        'error'   => 'LoginInvalidException',
        'message' => 'O login está incorreto',
    ]);
});
