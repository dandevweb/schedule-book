<?php

use App\Models\{Contact, User};

use function Pest\Laravel\{actingAs, putJson};

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

test('it can update a contact', function () {
    $contact = Contact::factory()->create(['user_id' => $this->user->id]);

    $updatedData = [
        'name'         => 'Jane Doe',
        'email'        => 'jane.doe@example.com',
        'phone'        => '0987654321',
        'zip_code'     => '87654-321',
        'address'      => '321 Elm St',
        'neighborhood' => 'Uptown',
        'number'       => '654',
        'complement'   => 'Suite 321',
        'city'         => 'Gotham',
        'state'        => 'NJ',
    ];

    putJson(route('api.contacts.update', $contact->id), $updatedData)
        ->assertOk()
        ->assertJson([
            'data' => array_merge(['id' => $contact->id], $updatedData),
        ]);
});

test('it returns 404 if contact to update is not found', function () {
    $updatedData = [
        'name'         => 'Jane Doe',
        'email'        => 'jane.doe@example.com',
        'phone'        => '0987654321',
        'zip_code'     => '87654-321',
        'address'      => '321 Elm St',
        'neighborhood' => 'Uptown',
        'number'       => '654',
        'complement'   => 'Suite 321',
        'city'         => 'Gotham',
        'state'        => 'NJ',
    ];

    putJson(route('api.contacts.update', 9999), $updatedData)
        ->assertStatus(404)
        ->assertJson([
            'message' => 'No query results for model [App\\Models\\Contact] 9999',
        ]);
});

test('it returns validation errors for invalid update data', function () {
    $contact = Contact::factory()->create(['user_id' => $this->user->id]);

    $invalidData = [
        'name'         => '', // Invalid: required
        'email'        => 'invalid-email', // Invalid: format
        'phone'        => '123456789012345thisisaverylongnumberthatexceedsthelengthlimit', // Invalid: max length
        'zip_code'     => '', // Invalid: required
        'address'      => '', // Invalid: required
        'neighborhood' => '', // Invalid: required
        'number'       => 'thisisaverylongnumberthatexceedsthelengthlimit', // Invalid: max length
        'city'         => '', // Invalid: required
        'state'        => '', // Invalid: required
    ];

    putJson(route('api.contacts.update', $contact->id), $invalidData)
        ->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
            'email',
            'phone',
            'zip_code',
            'address',
            'neighborhood',
            'number',
            'city',
            'state',
        ]);
});
