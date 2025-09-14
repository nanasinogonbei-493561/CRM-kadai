<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Company::create([
            'name' => 'Test Company',
        ]);
         Company::create([
            'name' => 'Test Company2',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
