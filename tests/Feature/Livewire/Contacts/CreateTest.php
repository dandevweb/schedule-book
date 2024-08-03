<?php

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Contacts\Form;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('should be able to create a contact', function () {
    Livewire::test(Form::class)
        ->set('name', 'John Doe')
        ->assertPropertyWired('name')
        ->set('email', 'john@doe.com')
        ->assertPropertyWired('email')
        ->set('phone', '(11) 99999-9999')
        ->assertPropertyWired('phone')
        ->set('zip_code', '08900-000')
        ->assertPropertyWired('zip_code')
        ->set('address', 'Rua do bobos')
        ->assertPropertyWired('address')
        ->set('neighborhood', 'Centro')
        ->assertPropertyWired('neighborhood')
        ->set('city', 'São Paulo')
        ->assertPropertyWired('city')
        ->set('state', 'SP')
        ->assertPropertyWired('state')
        ->set('number', '123')
        ->assertPropertyWired('number')
        ->set('complement', 'Apt. 123')
        ->assertPropertyWired('complement')
        ->call('save')
        ->assertMethodWiredToForm('save')
        ->assertHasNoErrors();

    assertDatabaseHas('contacts', [
        'name'         => 'John Doe',
        'email'        => 'john@doe.com',
        'phone'        => '(11) 99999-9999',
        'zip_code'     => '08900-000',
        'address'      => 'Rua do bobos',
        'neighborhood' => 'Centro',
        'city'         => 'São Paulo',
        'state'        => 'SP',
        'number'       => '123',
        'complement'   => 'Apt. 123',
    ]);
});

describe('validations', function () {
    test('name should required', function ($rule, $value) {
        Livewire::test(Form::class)
            ->set('name', $value)
            ->call('save')
            ->assertHasErrors(['name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('email should required', function ($rule, $value) {
        Livewire::test(Form::class)
            ->set('email', $value)
            ->call('save')
            ->assertHasErrors(['email' => $rule]);
    })->with([
        'required' => ['required', ''],
        'email'    => ['email', '123'],
    ]);

    test('phone should required', function ($rule, $value) {
        Livewire::test(Form::class)
            ->set('phone', $value)
            ->call('save')
            ->assertHasErrors(['phone' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);

    test('zip_code should required', function ($rule, $value) {
        Livewire::test(Form::class)
            ->set('zip_code', $value)
            ->call('save')
            ->assertHasErrors(['zip_code' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('address should required', function ($rule, $value) {
        Livewire::test(Form::class)
            ->set('address', $value)
            ->call('save')
            ->assertHasErrors(['address' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('neighborhood should required', function ($rule, $value) {
        Livewire::test(Form::class)
            ->set('neighborhood', $value)
            ->call('save')
            ->assertHasErrors(['neighborhood' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);

    test('city should required', function ($rule, $value) {
        Livewire::test(Form::class)
            ->set('city', $value)
            ->call('save')
            ->assertHasErrors(['city' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('state should required', function ($rule, $value) {
        Livewire::test(Form::class)
            ->set('state', $value)
            ->call('save')
            ->assertHasErrors(['state' => $rule]);
    })->with([
        'required' => ['required', ''],
        'max'      => ['max', str_repeat('a', 256)],
    ]);
});
