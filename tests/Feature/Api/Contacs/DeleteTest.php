<?php

use App\Models\{Contact, User};

use function Pest\Laravel\{actingAs, deleteJson};

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

test('it can delete a contact', function () {
    $contact = Contact::factory()->create(['user_id' => $this->user->id]);

    deleteJson(route('api.contacts.destroy', $contact->id))
        ->assertNoContent();

    $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
});

test('it returns 404 if contact to delete is not found', function () {
    deleteJson(route('api.contacts.destroy', 999))
        ->assertStatus(404)
        ->assertJson([
            'message' => 'No query results for model [App\\Models\\Contact] 999',
        ]);
});
