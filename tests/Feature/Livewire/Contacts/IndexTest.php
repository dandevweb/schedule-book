<?php

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Contacts\Index;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('renders successfully', function () {
    Livewire::test(Index::class)
        ->assertStatus(200);
});
