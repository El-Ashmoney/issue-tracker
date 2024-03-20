<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sector;
use Illuminate\Database\Seeder;
use Database\Seeders\SectorsSeeder;
use Database\Seeders\EntitiesSeeder;
use Database\Seeders\CompaniesSeeder;
use Database\Seeders\IssueOwnersSeeder;
use Database\Seeders\IssueAssigneesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(IssueAssigneesSeeder::class);
        // $this->call(EntitiesSeeder::class);
        // $this->call(CompaniesSeeder::class);
        // $this->call(IssueOwnersSeeder::class);
        // $this->call(SectorsSeeder::class);
    }
}
