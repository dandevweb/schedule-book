<?php

use App\Livewire\Contacts\Form;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Form::class)
        ->assertStatus(200);
});
