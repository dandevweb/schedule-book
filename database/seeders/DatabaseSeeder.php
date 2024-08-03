<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->withContacts(50)->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->withContacts(20)->create();
    }
}
