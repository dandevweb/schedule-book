<?php

use Livewire\Livewire;
use App\Models\{Contact, User};
use App\Livewire\Contacts\Index;

use function Pest\Laravel\{actingAs, assertDatabaseMissing};

beforeEach(function () {
    actingAs(User::factory()->create());
    $this->contact = Contact::factory()->create();
});

it('should be able to delete a contact', function () {
    Livewire::test(Index::class, ['modelId' => $this->contact->id])
        ->call('delete');

    assertDatabaseMissing('contacts', ['id' => $this->contact->id]);
});
