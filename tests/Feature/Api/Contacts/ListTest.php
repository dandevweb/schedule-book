<?php

use App\Models\{Contact, User};

use function Pest\Laravel\{actingAs, get};

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

test('it can list contacts', function () {
    Contact::factory()->count(5)->create(['user_id' => $this->user->id]);

    get(route('api.contacts.index'))
        ->assertOk()
        ->assertJsonCount(5, 'data');
});

test('it can paginate contacts', function () {
    Contact::factory()->count(15)->create(['user_id' => $this->user->id]);

    get(route('api.contacts.index', ['perPage' => 11]))
        ->assertOk()
        ->assertJsonCount(11, 'data');

    get(route('api.contacts.index', ['perPage' => 13, 'page' => 2]))
        ->assertOk()
        ->assertJsonCount(2, 'data');
});

test('it can filter contacts by search term', function () {
    Contact::factory()->create(['user_id' => $this->user->id, 'name' => 'John Doe']);
    Contact::factory()->create(['user_id' => $this->user->id, 'name' => 'Jane Smith']);
    Contact::factory()->create(['user_id' => $this->user->id, 'name' => 'Jake Johnson']);

    get(route('api.contacts.index', ['search' => 'John']))
        ->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment(['name' => 'John Doe'])
        ->assertJsonFragment(['name' => 'Jake Johnson']);
});

test('it can paginate contacts with correct json structure', function () {
    Contact::factory()->count(15)->create(['user_id' => $this->user->id]);

    get(route('api.contacts.index', ['perPage' => 10]))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
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
            ],
            'links',
            'meta'
        ])
        ->assertJsonCount(10, 'data');

    get(route('api.contacts.index', ['perPage' => 10, 'page' => 2]))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
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
            ],
            'links',
            'meta'
        ])
        ->assertJsonCount(5, 'data');
});

test('it can return specified columns only', function () {
    Contact::factory()->count(5)->create(['user_id' => $this->user->id]);

    $columns = ['id', 'name', 'email'];

    get(route('api.contacts.index', ['columns' => $columns]))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
        ])
        ->assertJsonMissing([
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
        ]);
});
