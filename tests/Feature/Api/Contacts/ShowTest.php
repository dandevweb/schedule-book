<?php

use App\Models\{User};

use App\Models\Contact;

use function Pest\Laravel\{actingAs, getJson};

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});


test('it returns correct json structure when getting a contact by id', function () {
    $contact = Contact::factory()->create(['user_id' => $this->user->id]);

    getJson(route('api.contacts.show', $contact->id))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
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
        ])
        ->assertJson([
            'data' => [
                'id'           => $contact->id,
                'name'         => $contact->name,
                'email'        => $contact->email,
                'phone'        => $contact->phone,
                'zip_code'     => $contact->zip_code,
                'address'      => $contact->address,
                'neighborhood' => $contact->neighborhood,
                'number'       => $contact->number,
                'complement'   => $contact->complement,
                'city'         => $contact->city,
                'state'        => $contact->state,
                'created_at'   => $contact->created_at->toISOString(),
                'updated_at'   => $contact->updated_at->toISOString(),
            ],
        ]);
});

test('it returns 404 if contact not found', function () {
    getJson(route('api.contacts.show', 999))
        ->assertStatus(404)
        ->assertJson([
            'message' => 'No query results for model [App\\Models\\Contact] 999',
        ]);
});
