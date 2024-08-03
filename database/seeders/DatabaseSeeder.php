<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->hasContacts(30)->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->hasContacts(30)->create();
    }
}
