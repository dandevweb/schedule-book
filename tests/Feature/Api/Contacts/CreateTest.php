<?php

use App\Models\{User};

use function Pest\Laravel\{actingAs, postJson};

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

test('it can create a contact', function () {
    $data = [
        'user_id'      => $this->user->id,
        'name'         => 'John Doe',
        'email'        => 'john.doe@example.com',
        'phone'        => '1234567890',
        'zip_code'     => '12345-678',
        'address'      => '123 Main St',
        'neighborhood' => 'Downtown',
        'number'       => '456',
        'complement'   => 'Apt 789',
        'city'         => 'Metropolis',
        'state'        => 'NY',
    ];

    postJson(route('api.contacts.store'), $data)
        ->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'id',
                'user_id',
                'name',
                'email',
                'phone',
                'zip_code',
                'address',
                'neighborhood',
                'number',
                'complement',
                'city',
                'state',
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('contacts', $data);
});

test('it validates required fields when creating a contact', function () {
    $data = [];

    postJson(route('api.contacts.store'), $data)
        ->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
            'email',
            'phone',
            'zip_code',
            'address',
            'neighborhood',
            'city',
            'state',
        ]);
});

test('it returns correct json structure when creating a contact', function () {
    $data = [
        'user_id'      => $this->user->id,
        'name'         => 'John Doe',
        'email'        => 'john.doe@example.com',
        'phone'        => '1234567890',
        'zip_code'     => '12345-678',
        'address'      => '123 Main St',
        'neighborhood' => 'Downtown',
        'number'       => '456',
        'complement'   => 'Apt 789',
        'city'         => 'Metropolis',
        'state'        => 'NY',
    ];

    postJson(route('api.contacts.store'), $data)
        ->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'id',
                'user_id',
                'name',
                'email',
                'phone',
                'zip_code',
                'address',
                'neighborhood',
                'number',
                'complement',
                'city',
                'state',
                'created_at',
                'updated_at',
            ],
        ]);
});
