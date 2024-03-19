<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sectors')->delete();
        DB::table('sectors')->insert([
            ['entity_id' => 3, 'name' => 'Individual Contract'],
            ['entity_id' => 3, 'name' => 'Back Labor'],
            ['entity_id' => 3, 'name' => 'Replace Labor'],
            ['entity_id' => 3, 'name' => 'Receipt Voucher'],
            ['entity_id' => 3, 'name' => 'Project Timesheet'],
            ['entity_id' => 3, 'name' => 'Employees'],
            ['entity_id' => 3, 'name' => 'Edit Salary Request'],
            ['entity_id' => 3, 'name' => 'Contacts'],
            ['entity_id' => 3, 'name' => 'Lead'],
            ['entity_id' => 3, 'name' => 'Individual Contract Procedures'],
            ['entity_id' => 3, 'name' => 'Individual Contract Requests'],
            ['entity_id' => 3, 'name' => 'Cities'],
            ['entity_id' => 3, 'name' => 'Districts'],
            ['entity_id' => 3, 'name' => 'Individual Pricing'],
            ['entity_id' => 3, 'name' => 'Escape Labor'],
            ['entity_id' => 3, 'name' => 'Slider Item'],
            ['entity_id' => 3, 'name' => 'Individual Discount'],
            ['entity_id' => 3, 'name' => 'Individual Pricing Discount'],
            ['entity_id' => 3, 'name' => 'Offers'],
            ['entity_id' => 4, 'name' => 'Service Contract Per Hour'],
            ['entity_id' => 4, 'name' => 'Hourly Visits'],
            ['entity_id' => 4, 'name' => 'Car Delivery Order'],
            ['entity_id' => 4, 'name' => 'Evaluation'],
            ['entity_id' => 4, 'name' => 'Vacation / Final Exit Request'],
            ['entity_id' => 4, 'name' => 'Hourly Pricing'],
            ['entity_id' => 4, 'name' => 'Payment Receipt'],
            ['entity_id' => 4, 'name' => 'Hourly Clearance'],
            ['entity_id' => 4, 'name' => 'Selected Hourly Pricing'],
            ['entity_id' => 4, 'name' => 'Car Hour Resources'],
            ['entity_id' => 4, 'name' => 'Services'],
            ['entity_id' => 4, 'name' => 'Change Over Form'],
            ['entity_id' => 4, 'name' => 'Housing Building'],
            ['entity_id' => 4, 'name' => 'Car Resources'],
            ['entity_id' => 4, 'name' => 'Nationallity Group'],
        ]);
    }
}
