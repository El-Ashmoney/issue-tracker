<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EntitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('entities')->delete();
        DB::table('entities')->insert([
            ['name' => 'Workplace'],
            ['name' => 'Sales'],
            ['name' => 'Domestic Sales'],
            ['name' => 'Hourly Sector'],
            ['name' => 'Recruitment'],
            ['name' => 'Housing'],
            ['name' => 'Human Resources'],
            ['name' => 'Call Center'],
            ['name' => 'Finance'],
            ['name' => 'Customer Care'],
            ['name' => 'Government Regulations'],
            ['name' => 'Marketing'],
            ['name' => 'Collection'],
            ['name' => 'Business Pricing'],
            ['name' => 'XRM'],
            ['name' => 'Setting'],
        ]);
    }
}