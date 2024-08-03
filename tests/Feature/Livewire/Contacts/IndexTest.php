<?php

use Livewire\Livewire;
use App\Models\{Contact, User};
use App\Livewire\Contacts\Index;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\{actingAs, get};

beforeEach(function () {
    uses(RefreshDatabase::class);
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('renders contact list successfully', function () {
    Livewire::test(Index::class)->assertOk();
    get(route('contacts'))->assertOk();
});

test("let's create a livewire component to list all contacts in the page", function () {
    $contacts = Contact::factory()->count(10)->create();

    $lw = Livewire::test(Index::class);

    $lw->assertSet('contacts', function ($items) {
        expect($items)
        ->toHaveCount(10);

        return true;
    });

    foreach ($contacts as $contact) {
        $lw->assertSee($contact->name);
        $lw->assertSee($contact->email);
        $lw->assertSee($contact->phone);
        $lw->assertSee($contact->city);
    }
});

it('should be able to paginate the result', function () {
    Contact::factory(30)->create();

    Livewire::test(Index::class)
        ->assertSet('contacts', function (LengthAwarePaginator $items) {
            expect($items)
                ->toHaveCount(10);

            return true;
        });

});
